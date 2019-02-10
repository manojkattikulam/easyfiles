
<div class="home-inner container">

<!-- ALERT MESSAGE -->       
<?php if($this->session->flashdata('class')): ?>
  <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible fade show text-center" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button> 
    <?php echo $this->session->flashdata('message');?>
  </div>
<?php endif; ?>
<!--END ALERT MESSAGE -->   


  <div class="row">

    <div class="col-md-8 mx-auto page-404">
    
    <h1 class="display-1 text-danger text-center zeroheading"> Currency Converter </h1>

    
<table>
         <tr>
             <td><input id="fromAmount" type="text" size="15" value="1" onkeyup="convertCurrency();"/></td>
             <td>
                 <select id="from" onchange="convertCurrency();">
                 <option value="AUD">Australian Dollar (AUD)</option>
                 <option value="BGN">Bulgarian Lev (BGN)</option>
                 <option value="CAD">Canadian Dollar (CAD)</option>
                 <option value="CHF">Swiss Franc (CHF)</option>
                 <option value="DKK">Danish Krone (DKK)</option>
                 <option value="EUR" selected>EURO (EUR)</option>
                 <option value="GBP">Pound Sterling (GBP)</option> 
                 <option value="ILS">Israeli New Shekel (ILS)</option>
                 <option value="INR">Indian Rupee (INR)</option>
                 <option value="JPY">Japanese Yen (JPY)</option>
                 <option value="PHP">Philippine Peso (PHP)</option>
                 <option value="RUB">Russian Ruble (RUB)</option>
                 <option value="USD">US Dollar (USD)</option>
                 </select>
             </td>
         </tr>
         <tr>
            <td><input id="toAmount" type="text" size="15" disabled/></td>
             <td>
                 <select id="to" onchange="convertCurrency();">
                 <option value="USD selected">US Dollar (USD)</option>
                 <option value="AUD">Australian Dollar (AUD)</option>
                 <option value="BGN">Bulgarian Lev (BGN)</option>
                 <option value="CAD">Canadian Dollar (CAD)</option>
                 <option value="CHF">Swiss Franc (CHF)</option>
                 <option value="DKK">Danish Krone (DKK)</option>
                 <option value="EUR">EURO (EUR)</option>
                 <option value="GBP">Pound Sterling (GBP)</option> 
                 <option value="ILS">Israeli New Shekel (ILS)</option>
                 <option value="INR">Indian Rupee (INR)</option>
                 <option value="JPY">Japanese Yen (JPY)</option>
                 <option value="PHP">Philippine Peso (PHP)</option>
                 <option value="RUB">Russian Ruble (RUB)</option>
                 
                 </select>
             </td>
         </tr>
     </table>

</div><!--end of row-->
</div><!--end of home-inner-->

<!-- end of banner -->
</header>
<!-- end of header -->







