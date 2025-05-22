import axios from 'axios';
import moment from 'moment';
import React, { useEffect, useMemo, useState } from 'react';
import ReactDOM from 'react-dom/client';
import { ToastContainer } from 'react-toastify';
import Select from 'react-select'
import { captureErrors } from '../helpers';

export default function UrgentInvoiceCreate(props) {

  const [invoiceOptions, setInvoiceOptions] = useState([
    {
      value: '0',
      label: 'None',
      isDisabled: false
    },
    {
      value: '1',
      label: 'Option A',
      isDisabled: false
    },
    {
      value: '2',
      label: 'Option B',
      isDisabled: false
    },
    {
      value: '3',
      label: 'Option C',
      isDisabled: false
    }
  ])


  const [disableFields, setDisableFields] = useState([])

  const [formData, setFormData] = useState({
    delivery_order_no: "",
    invoice_date: moment().format("YYYY-MM-DD"),
    invoice_number: '',
    invoice_type: '',
    invoice_category: '',
    invoice_option: '',
    customer: null,
    customer_id: null,
    payment_terms: '',
    credit_days: '',
    credit_limit:'',
    po_number: '',
    ref_number: '',
    employee_id: null,
    warehouse_id: null,
    items: [],
    subTotal:'',
    vatRate:'',
    vatAmount:'',
    totalDiscount:'',
    grandTotal:'',
    mainDiscount: '',
    mainDiscountType:'fixed'
  })

  const [selectedDeliverOrder, setSelectedDeliverOrder] = useState(null)
  const [selectedEmployee, setSelectedEmployee] = useState(null)

  const [customers, setCustomers] = useState([])
  const [employees, setEmployees] = useState([])
  const [urgentDeliveries, setUrgentDeliveries] = useState([])
  const [billTypes, setBillTypes] = useState([])
  const [warehouses, setWarehouses] = useState([])
  const [customerTerms, setCustomerTerms] = useState([])
  const [isCustomerTermsDisabled, setIsCustomerTermsDisabled] = useState(false)
  const [customerCreditPeriod, setCustomerCreditPeriod] = useState([])
  const [vatRate, setVatRate] = useState(18)
  useEffect(() => {
    if (props?.customers) {
      setCustomers(JSON.parse(props?.customers))
    }

    if (props?.employees) {
      setEmployees(JSON.parse(props?.employees))
    }

    if (props?.urgentdeliveries) {
      setUrgentDeliveries(JSON.parse(props?.urgentdeliveries))
    }

    if (props?.billtypes) {
      setBillTypes(JSON.parse(props?.billtypes))
    }

    if (props?.warehouses) {
      setWarehouses(JSON.parse(props?.warehouses))
    }

    if (props?.customerterms) {
      setCustomerTerms(JSON.parse(props?.customerterms))
    }

    if (props?.customercreditperiod) {
      setCustomerCreditPeriod(JSON.parse(props?.customercreditperiod))
    }

    if (props?.vatrate) {
      setVatRate(props?.vatrate)
    }



  }, [props])

  useEffect(() => {
    async function fetchInvoiceNumber() {
      const { data } = await axios.get('/urgent_invoice/get/invoice_no', { params: { invoice_category: formData?.invoice_category } })
      setFormData({ ...formData, invoice_number: data })
    }
    if (formData?.invoice_category) {
      fetchInvoiceNumber()
    }
  }, [formData?.invoice_category])


  function onItemChange(index, newItem) {
    const temItems = [...formData?.items]
    temItems.splice(index, 1, newItem)
    setFormData({ ...formData, items: temItems })
  }

  function syncUnitRates() {
    const temItems = [...formData?.items]
    const fixedUnitRate = temItems?.map(row => {
      let unit_rate = row?.unit_rate
      if (formData?.invoice_option == '1') {
        const vatRate = 18
        const newUnitPrice = row?.unit_rate / ((100 + vatRate) / 100)
        unit_rate = newUnitPrice ? newUnitPrice?.toFixed(2) : '';
      }
      return {
        ...row,
        unit_rate
      }
    })
    setFormData({ ...formData, items: fixedUnitRate })
  }

  const totalItemListDiscount=  useMemo(() => {
    return formData?.items?.filter(row => row?.isSelected)?.reduce((acc, curr) => {
      let discount = 0;
      const itemAmount = curr?.issued_qty * curr?.unit_rate || 0
      if (curr?.discount_type == "fixed") {
        discount = curr?.discount_amount || 0
      }
      if (curr?.discount_type == "percentage") {
        discount = (itemAmount * curr?.discount_amount) / 100 ?? 0
      }
      return acc + discount
    }, 0)
  }, [formData?.items])


  const subTotal = useMemo(() => {
    return formData?.items?.filter(row => row?.isSelected).reduce((acc, curr) => {
      return acc + curr?.issued_qty * curr?.unit_rate - curr?.discount_amount  || 0
    }, 0)
  }, [formData?.items])

  const vatAmount = useMemo(() => {
    if (formData?.invoice_option == '0') {
      return 0
    }
    if (formData?.invoice_option == '2') {
      const excludeVat = subTotal / ((100 + vatRate) / 100);
      return excludeVat * (vatRate / 100);
    }
    return subTotal * (vatRate / 100);
  }, [formData, subTotal])

  const netTotal = useMemo(() => {
    return subTotal + vatAmount;
  }, [subTotal, vatAmount])

  const totalDiscount = useMemo(() => {
    let mainDiscountAmout = 0
    if(formData.mainDiscountType == "percentage" ){
        mainDiscountAmout = (netTotal * formData.mainDiscount ?? 0)/100
    }
    if(formData.mainDiscountType == "fixed" ){
        mainDiscountAmout = formData.mainDiscount ??0
    }
    return totalItemListDiscount + mainDiscountAmout
  }, [totalItemListDiscount,formData.mainDiscount, netTotal])



  const grandTotal = useMemo(() => {
    return netTotal - totalDiscount
  }, [netTotal, totalDiscount])


  async function onSubmit() {
    const requestData = Object.assign({}, formData)
    requestData.items = [...requestData.items]?.filter(row => row?.isSelected)


    try {
      const response = await axios.post('/urgent_invoice/create', requestData)
       window.location.href = "/urgent_invoice"
       //window.location.href = "/UrgentInvoice.index"
    } catch (error) {
      captureErrors(error)
    }

  }
  console.log(formData?.invoice_option);
  return (
    <div className="content-wrapper">
      <div className="row">
        <div className="col-12 grid-margin stretch-card">
          <div className="card">
            <div className="card-body">
              <h4 className="card-title">Urgent Invoice</h4>
              <div>
                <div className="row">
                  <div className="form-group col-md-2">
                    <label>Select D/O</label>
                    <select
                      onChange={event => {
                        const value = event.target.value
                        const deliveryOrder = urgentDeliveries?.find(row => String(row?.id) === value)
                        const customer = deliveryOrder?.get_customer
                        setSelectedDeliverOrder(deliveryOrder)
                        const mappedItems = deliveryOrder?.items?.map(row => {
                          return {
                            ...row,
                            isSelected: false,
                            unit_rate: '',
                            weight: '0',
                            discount_type: '',
                            discount_amount: '0',
                            itemTotal:''

                          }
                        })

                        if(customer?.customer_payment_terms == "cash"){
                            setIsCustomerTermsDisabled(true)
                        }
                        if(customer?.customer_payment_terms !== "cash"){
                            setIsCustomerTermsDisabled(false)
                        }

                        setFormData({
                            ...formData,
                            delivery_order_no: value,
                            items: mappedItems,
                            customer,
                            customer_id: customer?.id,
                            payment_terms: customer?.customer_payment_terms ?? "",
                            credit_days: customer?.customer_payment_terms !== "cash"? customer?.customer_credit_period ?? "" : "",
                            warehouse_id: deliveryOrder?.location_id
                         })
                      }}
                      className="form-control do_input">
                      <option value="" selected disabled>Select</option>
                      {urgentDeliveries?.map(row => {
                        return <option value={row?.id}>{row?.delivery_order_no}</option>
                      })}
                    </select>
                  </div>
                  <div className="form-group col-md-2">
                    <label>Invoice Date</label>
                    <input
                      onChange={event => {
                        const value = event.target.value
                        setFormData({ ...formData, invoice_date: value })
                      }}
                      type="date" className="form-control" value={formData.invoice_date} placeholder="Invoice Date" />
                  </div>
                  <div className="form-group col-md-2">
                    <label>Invoice No</label>
                    <input value={formData?.invoice_number} type="text" className="form-control" name="invoice_number"
                      placeholder="Invoice No" readOnly />
                  </div>
                  <div className="form-group col-md-2">
                    <label>Invoice Type</label>
                    <select
                      onChange={event => {
                        const tempDisableFields = [...disableFields]
                        const value = event.target.value
                        let invoice_category = ""
                        let invoice_option = ""
                        if (value == '1') {
                          invoice_category = billTypes?.find(row => row?.billtype_code == "UIN")?.id
                          invoice_option = "0"
                          if (!tempDisableFields?.includes('invoice_option')) {
                            tempDisableFields.push('invoice_option')
                            setDisableFields(tempDisableFields)
                          }
                        }
                        if (value == '2') {
                          invoice_category = billTypes?.find(row => row?.billtype_code == "UTI")?.id
                          setInvoiceOptions(invoiceOptions?.map(row => {
                            if (row?.value == 0) {
                              row.isDisabled = true
                            }
                            return {
                              ...row
                            }
                          }))
                          if (tempDisableFields?.includes('invoice_option')) {
                            setDisableFields(tempDisableFields.filter(row => row !== 'invoice_option'))
                          }
                        }
                        if (value == '3') {
                          invoice_category = billTypes?.find(row => row?.billtype_code == "USVT")?.id
                          invoice_option = "3"
                          if (!tempDisableFields?.includes('invoice_option')) {
                            tempDisableFields.push('invoice_option')
                            setDisableFields(tempDisableFields)
                          }
                        }
                        setFormData({ ...formData, invoice_type: value, invoice_category, invoice_option })
                      }}
                      onBlur={() => {
                        syncUnitRates()
                      }}
                      value={formData?.invoice_type}
                      className="form-control" name="invoice_type" id="invoice_type">
                      <option value={""}>Select</option>
                      <option value="1">Non-Tax Invoice</option>
                      <option value="2">Tax Invoice</option>
                      <option value="3">Suspended Tax Invoice</option>
                    </select>
                  </div>
                  <div className="form-group col-md-2">
                    <label>Category</label>
                    <select
                      value={formData?.invoice_category}
                      disabled={true}
                      className="form-control" name="invoice_category" readOnly id="invoice_category"
                      required>
                      <option value="">-</option>
                      {billTypes?.map(row => {
                        return <option value={row?.id}>{row?.billtype_code}</option>
                      })}
                    </select>
                  </div>
                  <div className="form-group col-md-2">
                    <label>Invoice Option</label>
                    <select
                      value={formData?.invoice_option}
                      disabled={disableFields?.includes('invoice_option')}
                      className="form-control" name="invoice_option" id="invoice_option"
                      onChange={event => {
                        setFormData({ ...formData, invoice_option: event?.target?.value })
                      }}
                      onBlur={() => {
                        syncUnitRates()
                      }}
                    >
                      <option value="">Select</option>
                      {invoiceOptions?.map(row => {
                        return (
                          <option disabled={row?.isDisabled} value={row?.value}>{row?.label}</option>
                        )
                      })}
                    </select>
                  </div>
                </div>
                <hr></hr>
                <div className="row">
                  <div className="form-group col-md-2">
                    <label>Customer Code</label>
                    <input value={formData?.customer?.customer_code} type="text" className="form-control" placeholder="cus_code" readOnly />
                  </div>
                  <div className="form-group col-md-4">
                    <label>Customer Name</label>

                    <Select
                      placeholder="Select Customer"
                      options={customers}
                      isDisabled
                      getOptionLabel={row => row?.customer_name}
                      getOptionValue={row => row?.id}
                      value={customers?.find(row =>row?.id == formData?.customer_id)?? null}
                      onChange={(value) => {
                        setFormData({
                          ...formData,
                          customer: value,
                          customer_id: value?.id,
                          payment_terms: value?.customer_payment_terms ?? "",
                          credit_days: value?.customer_credit_period ?? "",
                        })
                      }}
                    />
                  </div>
                  <div className="form-group col-md-2">
                    <label>Customer Vat No</label>
                    <input value={formData?.customer?.customer_vat_number} type="text" className="form-control" placeholder="cus_vat_no" readOnly />
                  </div>
                  <div className="form-group col-md-4">
                    <label>Customer Address</label>
                    <input value={formData?.customer?.customer_address_line1} type="text" className="form-control" placeholder="cus_address" readOnly />
                  </div>
                </div>
                <hr></hr>
                <div className="row">
                  <div className="form-group col-md-2">
                    <label>Term</label>
                    <select
                    disabled={isCustomerTermsDisabled}
                    onChange={(e) => {
                        setFormData({
                          ...formData,
                          payment_terms: e.target.value,
                          credit_days: '',
                        })
                      }}
                    value={formData?.payment_terms} name="payment_terms" className="form-control" id="payment_terms">
                      <option selected value="" disabled>Select Terms</option>
                      {customerTerms?.map(row => {
                        return (
                          <option value={row?.value}>
                            {row?.label}

                          </option>
                        )
                      })}
                    </select>
                  </div>
                  {formData?.payment_terms == 'credit' ?
                  <>
                  <div className="form-group col-md-4">
                    <label>Credit Limit</label>
                    <input value={formData?.customer?.customer_credit_limit} type="text" className="form-control" placeholder="credit_limit" readOnly />
                  </div>
                  <div className="form-group col-md-2">
                  <label>Credit Days</label>
                  <select
                  disabled={isCustomerTermsDisabled}
                   onChange={(e) => {
                      setFormData({
                        ...formData,
                        credit_days: e.target.value,
                      })
                    }}
                  value={formData?.credit_days} name="credit_days" className="form-control" id="credit_days">
                    <option selected value="" disabled>Select</option>

                    {customerCreditPeriod?.map(row => {
                      return (
                        <option value={row?.value}>
                          {row?.label}

                        </option>
                      )
                    })}
                  </select>
                </div>
                </>
                  :null}

                  <div className="form-group col-md-2">
                    <label>PO No</label>
                    <input
                      onChange={(e) => {
                        setFormData({
                          ...formData,
                          po_number: e.target.value,
                        })
                      }}
                      type="text" className="form-control" name="po_number" id="po_number" />
                  </div>
                  <div className="form-group col-md-2">
                    <label>Reference No</label>
                    <input
                      onChange={(e) => {
                        setFormData({
                          ...formData,
                          ref_number: e.target.value,
                        })
                      }}
                      type="text" className="form-control" name="ref_number" id="ref_number" />
                  </div>

                  <div className="form-group col-md-4">
                    <label>Sales Staff Name</label>
                    <Select
                      placeholder="Select Employee"
                      options={employees}
                      getOptionLabel={row => row?.employee_fullname}
                      getOptionValue={row => row?.id}
                      onChange={value => {
                        setFormData({ ...formData, employee_id: value?.id })
                      }}
                    />
                  </div>
                  <div className="form-group col-md-3">
                    <label>Warehouse</label>
                    <Select isDisabled
                      placeholder="Select Warehouse"
                      options={warehouses}
                      getOptionLabel={row => row?.warehouse_name}
                      getOptionValue={row => row?.id}
                      value={warehouses?.find(row => row?.id == formData?.warehouse_id)?? null}
                      onChange={value => {
                        setFormData({ ...formData, warehouse_id: value?.id })
                      }}
                    />
                  </div>
                </div>

                {/* Item Table */}
                {formData?.items?.length !== 0 ?
                  <div class="table-responsive">
                    <table class="table bordered form-group">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Stock No</th>
                          <th>Description</th>
                          <th>U/M</th>
                          <th style={{ minWidth: "150px" }}>Issue Qty</th>
                          <th style={{ minWidth: "150px" }}>Invoice Qty</th>
                          <th style={{ minWidth: "150px" }}>Unit Rate</th>
                          <th style={{ minWidth: "150px" }}>Weight</th>
                          <th style={{ minWidth: "150px" }}>Item Amount</th>
                          <th style={{ minWidth: "150px" }}>Discount Type</th>
                          <th style={{ minWidth: "150px" }}>Discount Amount</th>
                          <th style={{ minWidth: "150px" }}>Item Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        {formData?.items?.map((row, index) => {
                          const itemAmount = row?.issued_qty * row?.unit_rate || 0
                          let discount = 0;
                          if (row?.discount_type == "fixed") {
                            discount = row?.discount_amount || 0
                          }
                          if (row?.discount_type == "percentage") {
                            discount = (itemAmount * row?.discount_amount) / 100 ?? 0
                          }
                          const itemTotal = itemAmount - discount || 0
                          return (
                            <tr>
                              <td><input type="checkbox"
                                checked={row?.isSelected}
                                onChange={() => {
                                  onItemChange(index, { ...row, isSelected: !row?.isSelected })
                                }}
                              /></td>
                              <td>{row?.item?.stock_number}</td>
                              <td>{row?.item?.description}</td>
                              <td>{row?.item?.unit}</td>
                              <td><input class="form-control" type="number" value={row?.issued_qty} readOnly /></td>
                              <td><input class="form-control" type="number" value={row?.issued_qty} readOnly /></td>
                              <td  >
                                <input class="form-control" type="number" value={row?.unit_rate}
                                  onChange={event => {
                                    onItemChange(index, { ...row, unit_rate: event.target.value, isSelected: true })
                                  }}
                                  onBlur={(event) => {
                                    if (formData?.invoice_option == '1') {
                                      const vatRate = 18
                                      const newUnitPrice = event.target.value / ((100 + vatRate) / 100)
                                      onItemChange(index, { ...row, unit_rate: newUnitPrice ? newUnitPrice?.toFixed(2) : event.target.value })
                                    }
                                  }}
                                /></td>
                              <td><input class="form-control" type="number" value={row?.weight}
                                onChange={event => {
                                  onItemChange(index, { ...row, weight: event.target.value, isSelected: true })
                                }}
                              /></td>
                              <td><input class="form-control" type="number" value={itemAmount ? itemAmount?.toFixed(2) : 0} readOnly /></td>
                              <td>
                                <select
                                  onChange={event => {
                                    onItemChange(index, { ...row, discount_type: event.target.value, isSelected: true })
                                  }}
                                  className="form-control">
                                  <option value="">Select</option>
                                  <option value="percentage">Percentage</option>
                                  <option value="fixed">Fixed</option>
                                </select>
                              </td>
                              <td><input
                                onChange={event => {
                                  const value = event.target.value
                                  if (row?.discount_type == 'percentage' && Number(value) >= 100) {
                                    alert('discount amount cannot be more than 100 when discount type is percentage')
                                  } else {
                                    onItemChange(index, { ...row, discount_amount: value, isSelected: true })
                                  }

                                }}
                                class="form-control" type="number" value={row?.discount_amount} /></td>
                              <td><input class="form-control" type="number" readOnly value={itemTotal ? itemTotal?.toFixed(2) : 0} /></td>
                            </tr>
                          )
                        })}
                      </tbody>
                    </table>
                  </div>
                  : null}
                {/* Item Table */}
                <br></br>
                <hr></hr>
                <div class="row">
                  <div class="form-group col-sm-3 col-lg-2">
                    <label>Sub Total</label>
                    <input type="number" class="form-control" value={subTotal ? subTotal.toFixed(2) : subTotal}
                      readOnly />
                  </div>
                  <div class="form-group col-sm-3 col-lg-2">
                    <label>Vat Rate</label>
                    <input class="form-control" value={formData?.invoice_category && formData?.invoice_option != '0' ? vatRate + "%": ''}
                      readOnly />
                  </div>
                  <div class="form-group col-sm-3 col-lg-2">
                    <label>Vat Amount</label>
                    <input type="number" class="form-control" value={vatAmount ? vatAmount.toFixed(2) : vatAmount} readOnly />
                  </div>
                  <div class="form-group col-sm-3 col-lg-2">
                    <label>Net Total</label>
                    <input type="number" class="form-control" value={netTotal ? netTotal.toFixed(2) : netTotal} readOnly />
                  </div>
                  <div class="form-group col-sm-3 col-lg-2">
                    <label>Total Discount</label>
                    <input type="number" class="form-control" value={totalDiscount && Number(totalDiscount) ? Number(totalDiscount)?.toFixed(2) : totalDiscount} readOnly />
                  </div>

                  <div class="form-group col-sm-3 col-lg-2">
                    <label>Grand Total</label>
                    <input type="number" class="form-control" value={grandTotal ? grandTotal.toFixed(2) : grandTotal} readOnly />
                  </div>
                </div>
                <button onClick={() => onSubmit()} class="btn btn-success me-2">Create Invoice</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <ToastContainer
        theme='dark'
        hideProgressBar
      />
    </div >
  )
}


if (document.getElementById('urgentInvoiceCreate')) {
  const component = document.getElementById("urgentInvoiceCreate")
  const Index = ReactDOM.createRoot(component);
  const props = Object.assign({}, component.dataset)
  Index.render(
    <React.StrictMode>
      <UrgentInvoiceCreate  {...props} />
    </React.StrictMode>
  )
}
