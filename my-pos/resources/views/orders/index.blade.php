@extends('layouts.app')

@section('content')
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="float-start">Order Product</h5>
                </div>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Disc %</th>
                                <th>Total</th>
                                <th><button class="btn btn-sm btn-success add_more"><i class="fa fa-plus"></i></button></th>
                            </tr>
                        </thead>
                        <tbody class="addMoreProduct">
                            <tr>
                                <td>1</td>
                                <td>
                                    <select name="product_id[]" class="form-control product_id">
                                        <option value="">Select Item</option>
                                        @foreach ($products as $product)
                                        <option data-price="{{ $product->price }}" value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="quantity[]" class="form-control quantity" min="1" value="1"></td>
                                <td><input type="number" name="price[]" class="form-control price" readonly></td>
                                <td><input type="number" name="discount[]" class="form-control discount" value="0" min="0"></td>
                                <td><input type="number" name="total_amount[]" class="form-control total_amount" readonly></td>
                                <td><button class="btn btn-sm btn-danger delete"><i class="fa fa-times"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Total: <b class="total">0.00</b></h5>
                </div>
                <div class="card-body">
                    <div class="btn-group">
                        <button type="button" onclick="PrintReceiptContent('print')" class="btn btn-dark">
                            <i class="fa fa-print"></i>Print
                        </button>
                        <button type="button" onclick="PrintHistoryContent('history')" class="btn btn-primary">
                            <i class="fa fa-print"></i>History
                        </button>
                        <button type="button" onclick="PrintReportContent('report')" class="btn btn-danger">
                            <i class="fa fa-print"></i>Report
                        </button>
                    </div>
                    <div class="panel">
                        <div class="row">
                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        <label for="customer_name">Customer Name</label>
                                        <input type="text" name="customer_name" id="customer_name" class="form-control">
                                    </td>
                                    <td>
                                        <label for="customer_phone">Customer Phone</label>
                                        <input type="number" name="customer_phone" id="customer_phone" class="form-control">
                                    </td>
                                </tr>
                            </table>

                            <div class="col-12 mt-3">
                                <label for="payment_method">Payment Method</label><br>
                                <div class="d-flex align-items-center">
                                    <span class="radio-item me-3">
                                        <input type="radio" name="payment_method" id="payment_cash" value="cash" checked>
                                        <label for="payment_cash">
                                            <i class="fa fa-money-bill text-success"></i> Cash
                                        </label>
                                    </span>

                                    <span class="radio-item me-3">
                                        <input type="radio" name="payment_method" id="payment_bank" value="bank transfer">
                                        <label for="payment_bank">
                                            <i class="fa fa-university text-danger"></i> Bank Transfer
                                        </label>
                                    </span>

                                    <span class="radio-item">
                                        <input type="radio" name="payment_method" id="payment_card" value="credit card">
                                        <label for="payment_card">
                                            <i class="fa fa-credit-card text-info"></i> Credit Card
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <td">
                                <label for="paid_amount">Payment</label>
                                <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                        </td>
                            <td>
                                <label for="balance">Return Change</label>
                                <input type="number" name="balance" id="balance" class="form-control">
                            </td>
                            <td>
                                <button class="btn-primary btn-block mt-3">Save</button>
                            </td>
                            <td>
                                <a href="#"><i class="fa fa-lock ml-2 text-center">Logout</i></a>
                            </td>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printContent">
                <!-- Receipt content will be dynamically injected here -->
                @include('reports.receipt')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="printDiv('printContent')" class="btn btn-primary">Print Receipt</button>
            </div>
        </div>
    </div>
</div>

<!-- Custom Modal Styling -->
<style>
    .modal.right .modal-dialog {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        min-width: 300px;
    }
    .modal.fade:not( .on).right .modal-dialog{
        -webkit-transform: translate3d(25%, 0, 0);
        transform:translate3d(25%, , 0, 0);
    }
    .radio-item input[type="radio"]{
        width: 14px;
        height: 14px;
        margin: 0 5px 0 5px;
        padding: 0;
        color: blue;
    }
    .radio-item input[type="radio"]{
        position: relative;
        margin: 4px 5px 4px 0;
        display: inline-block;
        visibility:visible;
        width: 14px;
        height: 14px;
        border-radius: 10px;
        border: 2px inset;
        cursor: pointer;
    }
</style>
@endsection

@section('script')
@section('script')
<script>
$(document).ready(function(){
    // Adding a new row
    $('.add_more').on('click', function(e){
        e.preventDefault();
        var newRow = $('.addMoreProduct tr:first').clone();
        newRow.find('input').val('');
        newRow.find('.product_id').val('');
        $('.addMoreProduct').append(newRow);
        updateRowNumbers();
    });

    // Remove row
    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        $(this).closest('tr').remove();
        calculateTotal();
        calculateBalance();
    });
    // Calculate total for each row
    $(document).on('change keyup', '.product_id, .quantity, .discount', function(){
        var tr = $(this).closest('tr');
        updateRowTotal(tr);
        calculateTotal();
        calculateBalance();
    });
    // Fetch product price dynamically based on selection
    $(document).on('change', '.product_id', function(){
        var tr = $(this).closest('tr');
        var price = $(this).find('option:selected').data('price') || 0;
        tr.find('.price').val(price);
        updateRowTotal(tr);
        calculateTotal();
        calculateBalance();
    });

    // Calculate balance based on the total and paid amount
    $(document).on('input', '#paid_amount', function(){
        calculateBalance();
    });

    function updateRowTotal(tr) {
        var qty = parseFloat(tr.find('.quantity').val()) || 0;
        var price = parseFloat(tr.find('.price').val()) || 0;
        var discount = parseFloat(tr.find('.discount').val()) || 0;
        var total = qty * price * (1 - discount / 100);
        tr.find('.total_amount').val(total.toFixed(2));
    }

    function calculateTotal() {
        var total = 0;
        $('.total_amount').each(function(){
            total += parseFloat($(this).val()) || 0;
        });
        $('.total').text(total.toFixed(2));
    }

    function calculateBalance() {
        var totalAmount = parseFloat($('.total').text()) || 0;
        var paidAmount = parseFloat($('#paid_amount').val()) || 0;
        var balance = paidAmount - totalAmount;
        $('#balance').val(balance.toFixed(2));
    }

    function updateRowNumbers() {
        $('.addMoreProduct tr').each(function(i) {
            $(this).find('td:first').text(i + 1);
        });
    }
});

function PrintReceiptContent() {
    
    var receiptModal = new bootstrap.Modal(document.getElementById('receiptModal'), {});
    receiptModal.show();
}
function printDiv(divId) {
    var printContents = document.getElementById(divId).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload();
}
</script>
@endsection
