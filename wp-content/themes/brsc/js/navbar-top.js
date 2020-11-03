jQuery(document).ready(function($) {
  //assume height is in px
  let headTopHeight = $('.header-top').css('height').slice(0,3);
  //let foo = $('.header-top').css();
  let navMenu = $('#primary-menu');
  $(window).scroll(function () {

    var currentScroll = $(this).scrollTop();
    if (currentScroll > headTopHeight) {
      navMenu.addClass('scrolledDown');
      //stickNav(navMenu, endProps);
       //Prevent default on links with children under 768px
    } else {
      navMenu.removeClass('scrolledDown');
    }

  });
  const siteNavigation = document.getElementById( 'site-navigation' );
  const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];
  const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children' );
  const allSubmenus = $(linksWithChildren).find('.sub-menu');
  if ($(window).width() < 768){
    for (const menu of linksWithChildren){
    //add copy of link in submenu
    const link = menu.querySelector('a');
    const submenu = menu.querySelector('.sub-menu');
    createSubmenuItem(submenu, link);
    preventDeafultMenu(link);


    $(link).click(function() {
      if($(submenu).css('display') == 'none'){
        orderMenuFunctions(function(){$(submenu).addClass('sub-show')});
      } else {
        $(submenu).removeClass('sub-show');
      }
    })
    // $(submenu).hide();
    // $(link).click(function (){
    //   $(submenu).toggle();
    // })
    }
  }

  function orderMenuFunctions(callback){
    $(allSubmenus).removeClass('sub-show');
    callback();
  }

  function createSubmenuItem(targetList, linkToAdd){
    $(targetList).prepend($(linkToAdd).clone().addClass('menu-item menu-item-type-post_type menu-item-object-page'));
  }

  function preventDeafultMenu(menuItem){
    $(menuItem).click(function(event){
      event.preventDefault();

    })
  }

  function addSubmenuToggle(menu, submenu){

  }

})
