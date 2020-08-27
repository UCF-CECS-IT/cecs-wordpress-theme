let subMenuItems;

/**
 * Adds listeners to toggle the sub-navigation between dropup and dropdown
 * depending on the scroll height to ensure sub-nav menus are always visible
 */
window.onload = function () {
  subMenuItems = document.getElementById('sub-menu').childNodes[0].childNodes;

  window.addEventListener('scroll', () => {
    if (isAboveBreakpoint() && checkCurrentSetting(subMenuItems[0]) === false) {
      Array.prototype.forEach.call(subMenuItems, function(element) {
        addDropup(element);
      });
    }
  
    if (!isAboveBreakpoint() && checkCurrentSetting(subMenuItems[0]) === true) {
      Array.prototype.forEach.call(subMenuItems, function(element) {
        removeDropup(element);
      });
    }
  });
};

function isAboveBreakpoint() {
  if ((window.pageYOffset || document.documentElement.scrollTop) > 199) {
    return false;
  }
  return true;
}

function checkCurrentSetting(element) {
  return element.classList.contains('dropup');
}

function addDropup(element) {
  element.classList.add('dropup');
}

function removeDropup(element) {
  element.classList.remove('dropup');
}

$(function() {

  $('.dropdown-submenu').click(function(event) {

      // Only triggers on the dropdown <a> link
      if (event.target.classList.contains('dropdown-toggle')) {
        event.preventDefault();
        event.stopPropagation();
        $(this).toggleClass('show');
  
      }
      
      /**
       * Resizes the dropdown element height to cover all of the child items.
       * Currently solved with CSS hack of applying background color manually
       * to sub-menu dropdown items. Retaining in case that proves unworkable.
       */

      // var dropdownMenu = $(this).children('.dropdown-menu');
      // var dropdownHeight = dropdownMenu.height();
      // var contentHeight = 0;
      
      // dropdownMenu.children().each(function() {
      //   contentHeight += $(this).height();
      // });

      // if (dropdownHeight < contentHeight) {
      //   dropdownMenu.height(contentHeight + 20);
      // }
  });
});
