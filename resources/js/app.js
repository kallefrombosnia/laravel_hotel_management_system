require('./bootstrap');
require('./daterangepicker');
require('../../node_modules/jquery/dist/jquery.min.js');


$('#roomSelect').on('change', () =>{

    // Get data price attribute from selected room
    let price = $('#roomSelect option:selected').data('price');

    if($('#roomSelect' ).hasClass( 'is-invalid' )){
        $('#roomSelect' ).removeClass('is-invalid');
        $('#room-error').text('');
    }

    // Set output price
    $('#outputPrice').val(price);
}); 



$('#inputName').on('focus', () =>{
    if($('#inputName').hasClass('is-invalid')){
        $('#inputName').removeClass('is-invalid');
        $('#name-error').text('');
    }
}); 

$('#inputEmail').on('focus', () =>{
    if($('#inputEmail').hasClass('is-invalid')){
        $('#inputEmail').removeClass('is-invalid');
        $('#email-error').text('');
    }
}); 

$('#inputPhone').on('focus', () =>{
    if($('#inputPhone').hasClass('is-invalid')){
        $('#inputPhone').removeClass('is-invalid');
        $('#phone-error').text('');
    }
}); 



const today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());

$(function() {

    $('#chooseDate').daterangepicker({
      minDate: today,
      maxSpan: {
        days: 30
      },
      autoUpdateInput: true,
    }, (start, end, label) => {

        const daysReserved = calculateDaysReserved(start, end);

        calculateDiscount(daysReserved);
    })
});


const calculateDiscount = (days) => {

    const price = $('#roomSelect option:selected').data('price');

    // Could use switch but but follow logic is easier
    if(days){

        if(days >= 10){
            discount(days, price, 15);
        }else if(days >= 7 ){
            discount(days, price, 10);
        }else if(days >= 5 ){
            discount(days, price, 7);
        }else if(days >= 3 ){
            discount(days, price, 5);
        }else{
            return $('#outputPrice').val(price);
        }
    }

    return null;
}

const discount = (days, price, discount) =>{

    if(price && price !== '0' && discount){

        const priceInt = Number(price);
        const discountInt = Number(discount) / 100;
    
        const newTotalValue = priceInt- (priceInt * discountInt)
        
        $('#outputPrice').val(newTotalValue);

        $('#discount-message span').text(`We offer you a ${discount}% discount for the ${days} days in our hotel.`);
        $('#discount-message').show();

    }else{
        $('#discount-message').hide();
    }
}


const calculateDaysReserved = (startDate, endDate) => {

    if(startDate && endDate){

        let end = moment(endDate);
        let start = moment(startDate);

        return end.diff(start, 'days')
    }

    return 0;
}