let subMenuItems;

window.onload = function () {
  subMenuItems = document.getElementById('sub-menu').childNodes[0].childNodes;
};

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
  // ------------------------------------------------------- //
  // Multi Level dropdowns
  // ------------------------------------------------------ //
  $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
    event.preventDefault();
    event.stopPropagation();

    $(this).siblings().toggleClass("show");


    if (!$(this).next().hasClass('show')) {
      $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    }
    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
      $('.dropdown-submenu .show').removeClass("show");
    });

  });
});

