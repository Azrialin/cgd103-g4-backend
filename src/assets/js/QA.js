// click
$(function menuClick(){
    $('.parent-list>li>a').on('click', function (){
        $('.parent-list>li>a').not(this).removeClass('on');
        $('.parent-list>li>a').not(this).removeClass('show');
        $(this).addClass('on');
    });
    $('.child-list li a').on('click', function (){
        $('.child-list li a').not(this).removeClass('on');
        $(this).addClass('on');
    });
});