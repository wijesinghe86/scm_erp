import axios from "axios";
import moment from "moment";
import React, { useEffect, useMemo, useState } from "react";
import ReactDOM from "react-dom/client";
import Select from "react-select";
import { toast, ToastContainer } from 'react-toastify';

import { captureErrors } from "../helpers";

export default function UrgentInvoiceReturnCreate(props) {
    const [formData, setFormData] = useState({
        customer: null,
        customer_id: null,
        invoice_number: "",
        invoice: null,
        delivery_order_no: "",
        delivery_order: null,
        items: [],
        location: null,
        payment_method: null,
        return_reason: null
    });

    const [invoices, setInvoices] = useState([])

    const [customers, setCustomers] = useState([]);
    const [warehouses, setWarehouses] = useState([]);


    useEffect(() => {
        if (props?.customers) {
            setCustomers(JSON.parse(props?.customers));
        }

        if (props?.warehouses) {
            setWarehouses(JSON.parse(props?.warehouses));
        }
    }, [props]);


    useEffect(() => {
        async function fetchInvoiceNumber() {
            const { data } = await axios.get('/urgent_invoice/get/by_customer_id', { params: { customer_id: formData?.customer_id } })
            setInvoices(data.urgent_invoices)
        }
        if (formData?.customer_id) {
            fetchInvoiceNumber()
        }
    }, [formData?.customer_id])


    const handleSubmit = async () => {
        const requestData = Object.assign({}, formData)
        requestData.items = [...requestData.items]?.filter(row => row?.is_selected)

        const isValid = validateForm(requestData)
        if (!isValid) {
            return;
        }

        try {
            const response = await axios.post('/reverse_returns/new', requestData)
            //TODO:uncomment when the UrgentInvoiceReturn list component is created
            // window.location.href = "/reverse_returns"
        } catch (error) {
            captureErrors(error)
        }
    }

    const validateForm = (requestData) => {

        const errors = []

        if (!requestData?.customer_id) {
            errors.push("Please select a customer");
        }
        if (!requestData?.invoice_number) {
            errors.push("Please select an invoice");
        }
        if (!requestData?.payment_method) {
            errors.push("Please select a payment method");
        }
        if (formData.location == null) {
            errors.push("Please select a received location");
        }

        if (formData.return_reason == null) {
            errors.push("Please enter a return reason");
        }
        if (requestData?.items?.filter(row => row?.is_selected)?.length == 0) {
            errors.push("Please select at least one item");
        }



        if (errors.length > 0) {
            errors.forEach(error => {
                toast.error(error);
            });
            return false;
        }



        requestData?.items?.forEach((row,) => {
            if (!row?.returned_qty) {
                toast.error("Please enter a returned quantity for item " + row?.item?.stock_number);
                return false;
            }
        });

        return true;
    }

    return (
        <div className="content-wrapper">
            <div className="row">
                <div className="col-12 grid-margin stretch-card">
                    <div className="card">
                        <div className="card-body">
                            <h4 className="card-title">
                                Reverse Logistics Return Entry
                            </h4>

                            <div className="row">
                                <div className="form-group col-md-2">
                                    <label>Customer Code</label>
                                    <input
                                        value={
                                            formData?.customer?.customer_code
                                        }
                                        type="text"
                                        className="form-control"
                                        placeholder="cus_code"
                                        readOnly
                                    />
                                </div>
                                <div className="form-group col-md-4">
                                    <label>Customer Name</label>

                                    <Select
                                        placeholder="Select Customer"
                                        options={customers}
                                        getOptionLabel={(row) =>
                                            row?.customer_name
                                        }
                                        getOptionValue={(row) => row?.id}
                                        value={
                                            customers?.find(
                                                (row) =>
                                                    row?.id ==
                                                    formData?.customer_id
                                            ) ?? null
                                        }
                                        onChange={(value) => {
                                            setFormData({
                                                ...formData,
                                                customer: value,
                                                customer_id: value?.id,
                                            });
                                        }}
                                    />
                                </div>
                            </div>
                            <div className="row">
                                <div className="form-group col-md-4">
                                    <label>Invoice No</label>
                                    <Select
                                        placeholder="Select Invoice"
                                        options={invoices}
                                        getOptionLabel={(row) =>
                                            row?.invoice_number
                                        }
                                        getOptionValue={(row) => row?.id}
                                        value={
                                            invoices?.find(
                                                (row) =>
                                                    row?.invoice_number ==
                                                    formData?.invoice_number
                                            ) ?? null
                                        }
                                        onChange={(value) => {
                                            setFormData({
                                                ...formData,
                                                invoice: value,
                                                invoice_number: value?.invoice_number,
                                                delivery_order: value?.delivery_order,
                                                delivery_order_no: value?.delivery_order?.delivery_order_no,
                                                items: value?.delivery_order?.items?.map(row => {
                                                    return {
                                                        ...row,
                                                        is_selected: false
                                                    }
                                                })
                                            });
                                        }}
                                    />
                                </div>
                                <div className="form-group col-md-2">
                                    <label>DO No</label>
                                    <input
                                        value={
                                            formData?.delivery_order_no
                                        }
                                        type="text"
                                        className="form-control"
                                        placeholder=""
                                        readOnly
                                    />
                                </div>
                                <div className="form-group col-md-2">
                                    <label>Issued Location</label>
                                    <input
                                        value={
                                            formData?.delivery_order?.location?.warehouse_name
                                        }
                                        type="text"
                                        className="form-control"
                                        placeholder=""
                                        readOnly
                                    />
                                </div>
                                <div className="form-group col-md-4">
                                    <label>Received Location</label>
                                    <Select
                                        placeholder=""
                                        options={warehouses}
                                        getOptionLabel={(row) =>
                                            row?.warehouse_name
                                        }
                                        getOptionValue={(row) => row?.id}
                                        value={formData?.location ?? null}
                                        onChange={(value) => {
                                            setFormData({
                                                ...formData,
                                                location: value
                                            });
                                        }}
                                    />
                                </div>
                            </div>
                            <div className="row">

                                <div className="form-group col-md-8">
                                    <label>Return Reason</label>
                                    <input
                                        value={
                                            formData?.return_reason
                                        }
                                        onChange={e => setFormData({ ...formData, return_reason: e.target.value })}
                                        type="text"
                                        className="form-control"
                                        placeholder=""
                                    />
                                </div>
                                <div className="form-group col-md-4">
                                    <label>Payment Method</label>
                                    <select
                                        onChange={e => setFormData({ ...formData, payment_method: e.target.value })}
                                        name="payment_method" className="form-control item-select" id="payment_method">
                                        <option selected disabled>Select Terms</option>
                                        <option value="1">N/A</option>
                                        <option value="2">Cash</option>
                                        <option value="3">Credit</option>
                                    </select>
                                </div>
                            </div>
                            {formData?.delivery_order ?
                                <div className="table-responsive">
                                    <table className="table table-bordered" id="tbl_finishedgoods">
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <td>STOCK NO</td>
                                                <td>DESCRIPTION</td>
                                                <td>U/M</td>
                                                <td>UNIT PRICE</td>
                                                <td>ISSUED QTY</td>
                                                <td>RETURNABLE QTY</td>
                                                <td>RETURNED QTY</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {formData?.items?.map((row, index) => {
                                                const invoiceItem = formData?.invoice?.items?.find(item => item?.item_id == row?.item_id)
                                                return (
                                                    <tr key={index}>
                                                        <td>
                                                            <input type="checkbox" name="items[{{ index }}][is_selected]"
                                                                checked={row?.is_selected}
                                                                disabled={row?.remaining_qty == 0}
                                                                onChange={e => {
                                                                    const newItem = { ...row, is_selected: !row?.is_selected }
                                                                    const tempItems = [...formData?.items]
                                                                    tempItems.splice(index, 1, newItem)
                                                                    setFormData({
                                                                        ...formData,
                                                                        items: tempItems
                                                                    })
                                                                }} />
                                                        </td>
                                                        <td>{row?.item?.stock_number}</td>
                                                        <td>{row?.item?.description}</td>
                                                        <td>{row?.item?.unit}</td>
                                                        <td>{invoiceItem?.unit_price}</td>
                                                        <td>{row?.issued_qty}</td>
                                                        <td>{row?.remaining_qty}</td>
                                                        <td>
                                                            <input
                                                                className="form-control"
                                                                type="number"
                                                                name="items[{{ index }}][returned_qty]"
                                                                value={row?.returned_qty}
                                                                disabled={row?.remaining_qty == 0}
                                                                onChange={e => {
                                                                    const value = e.target.value
                                                                    if (value && parseFloat(value) > parseFloat(row?.remaining_qty)) {
                                                                        console.log("value", value);
                                                                        toast.error("Returned quantity cannot be greater than remaining quantity");
                                                                        return;
                                                                    } else {
                                                                        const newItem = { ...row, returned_qty: value }
                                                                        if (value) {
                                                                            newItem.is_selected = true
                                                                        }
                                                                        const tempItems = [...formData?.items]
                                                                        tempItems.splice(index, 1, newItem)
                                                                        setFormData({ ...formData, items: tempItems })
                                                                    }

                                                                }}
                                                            />
                                                        </td>
                                                    </tr>
                                                )
                                            })}
                                        </tbody>
                                    </table>
                                </div>
                                : null}

                            <div className="row mt-3" >
                                <div className="form-group col-md-2">
                                    <button className="btn btn-success me-2" name="button" onClick={handleSubmit} >Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ToastContainer
                theme='dark'
                hideProgressBar
            />
        </div>
    );
}

if (document.getElementById("urgentInvoiceReturnCreate")) {
    const component = document.getElementById("urgentInvoiceReturnCreate");
    const Index = ReactDOM.createRoot(component);
    const props = Object.assign({}, component.dataset);
    Index.render(
        <React.StrictMode>
            <UrgentInvoiceReturnCreate {...props} />
        </React.StrictMode>
    );
}
