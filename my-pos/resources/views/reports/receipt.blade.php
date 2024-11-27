

<div id="invoice-POS">
    <div class="printed_content">
        <center id="logo">
            <div class="logo">hossea</div>
            <div class="info"></div>
            <h1>POS Ltd</h1>
        </center>
    </div>

    <div class="mid">
        <div class="info">
            <h3>Contact Us</h3>
            <p>
                Address: mulamulamula <br>
                Email: mula@gmail.com <br>
                Phone: 0787678466
            </p>
        </div>
    </div>

    <div class="bot">
        <div id="table">
            <table>
                <tr class="tabletittle">
                    <td class="item"><h2>Item</h2></td>
                    <td class="hour"><h2>Qty</h2></td>
                    <td class="rate"><h2>Unit</h2></td>
                    <td class="rate"><h2>Discount</h2></td>
                    <td class="rate"><h2>Sub Total</h2></td>
                </tr>

                @foreach ($order_receipt as $receipt)
        <tr class="service">
            <td class="tableitem">
                <p class="itemtext">{{ $receipt->product->product_name }}</p>
            </td>
            <td class="tableitem">
                <p class="itemtext">{{ $receipt->quantity }}</p>
            </td>
            <td class="tableitem">
                <p class="itemtext">${{ number_format($receipt->unitprice, 2) }}</p>
            </td>
            <td class="tableitem">
                <p class="itemtext">{{ $receipt->discount }}</p>
            </td>
            <td class="tableitem">
                <p class="itemtext">${{ number_format($receipt->amount, 2) }}</p>
            </td>
        </tr>
    @endforeach

                <tr class="tabletittle">
                    <td colspan="3"></td>
                    <td class="rate"><p class="itemtext">Tax</p></td>
                    <td class="Payment"><p class="itemtext">${{ number_format($order_receipt->sum('amount') * 0.1, 2) }}</p></td>
                </tr>
                <tr class="tabletittle">
                    <td colspan="3"></td>
                    <td class="rate">Total</td>
                    <td class="Payment"><h2>${{ number_format($order_receipt->sum('amount'), 2) }}</h2></td>
                </tr>
            </table>

            <div class="legalcopy">
                <p class="legal"><strong>** Thank you for visiting **</strong><br>
                    The goods subject to tax include prices
                </p>
            </div>
            <div class="serial-number">
                Serial: <span class="serial">3456789643</span><br>
                <span>{{ now()->format('d/m/Y H:i') }}</span>
            </div>
        </div>
    </div>
</div>

<style>
    #invoice-POS{
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 58mm;
        background: #fff;
    }
    #invoice-POS::selection{
        background: #35585E;
        color: #fff;
    }
    #invoice-POS::-moz-selection{
        background: #35585E;
        color: #fff;
    }
    #invoice-POS h1{
        font-size: 1.5em;
        color: #222;
    }
    #invoice-POS h2{
        font-size: 0.9em;
    }
    #invoice-POS h3{
        font-size: 1.2em;
        font-weight: 300;
        line-height: 2em;
    }
    #invoice-POS p{
        font-size: 0.7em;
        line-height: 1.2em;
        color: #666;
    }
    #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot{
        border-bottom: 1px solid #eee;
    }
    #invoice-POS #top{
        min-height: 100px;
    }
    #invoice-POS #mid{
        min-height: 80px;
    }
    #invoice-POS #bot{
        min-height: 50px;
    }
    #invoice-POS .logo{
        height: 60px;
        width: 60px;
        background-image: url() no-repeat;
        background-size: 60px 60px;
        border-radius: 50px;
    }
    #invoice-POS .info{
        display: block;
        margin-left: 0;
        text-align: center;
    }
    #invoice-POS .itemtext{
        font-size: 0.5em;
    }
    #invoice-POS .item{
        font-size: 4mm;
    }
    #invoice-POS #legalcopy{
        margin-top: 5mm;
        text-align: center;
    }
    #invoice-POS h2{
        font-size: 0.5em;
    }
    .serial-number{
        margin-top: 5mm;
        margin-bottom: 2mm;
        text-align: center;
        font-size: 12px;
    }
    .serial{
        font-size: 10px !important;
    }

</style>
