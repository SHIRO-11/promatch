$(function(){
    $(window).scroll(function (){
        $('.fadein').each(function(){
            var position = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > position - windowHeight + 200){
                $(this).addClass('active');
            }
            
        
        });
        
        $('.fadein-speed').each(function(){
            var position = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > position - windowHeight + 200){
                $(this).addClass('active');
            }
            
        
        });
    });
    
    
//     const onMouseenter = (e) => {
//   // マウスが乗った時の処理
//   $(e.target).css({
//     'background-color': '#ff9999',
//   });
// };
// const onMouseleave = (e) => {
//   // マウスが外れた時の処理
//   $(e.target).css({
//     'background-color': '#dddddd',
//   });
// };

// $('.box')
//   .on('mouseenter', onMouseenter)
//   .on('mouseleave', onMouseleave);
});
