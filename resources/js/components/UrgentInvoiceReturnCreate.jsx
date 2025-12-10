import axios from "axios";
import moment from "moment";
import React, { useEffect, useMemo, useState } from "react";
import ReactDOM from "react-dom/client";
import { ToastContainer } from "react-toastify";
import Select from "react-select";
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
          console.log(formData.customer_id);
          console.log(data);
          setInvoices(data.urgent_invoices)
        }
        if (formData?.customer_id) {
          fetchInvoiceNumber()
        }
      }, [formData?.customer_id])

console.log(formData)
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
                                                items: value?.delivery_order?.items
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
                                <div class="form-group col-md-3">
                                <label>Payment Method</label>
                                <select 
                                onChange={value => setFormData({...formData, payment_method: value})}
                                name="payment_method" class="form-control item-select" id="payment_method">
                                    <option selected disabled>Select Terms</option>
                                    <option value="1">N/A</option>
                                    <option value="2">Cash</option>
                                    <option value="3">Credit</option>
                                </select>
                            </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
