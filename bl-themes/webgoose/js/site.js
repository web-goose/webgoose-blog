storage = window.localStorage;
themeKey = 'theme';
currentTheme = 'theme-light';

$(document).ready(() => {
    $('body').addClass(getThemeClass(themeKey));
    setThemeSwitcherStatus();
})

function getThemeClass(key) {
    currentTheme = storage.getItem(key);
    if (currentTheme == null) {
        updateThemeClass('theme-light');
    }
    return currentTheme;
}

function updateThemeClass(newThemeClass) {
    storage.setItem(themeKey, newThemeClass);
    $('body').removeClass();
    $('body').addClass(newThemeClass);
    currentTheme = newThemeClass;
    setThemeSwitcherStatus();
}

function setThemeSwitcherStatus() {
    if (storage.getItem(themeKey) != 'theme-light') {
        $('#themeSwitcher').prop('checked', true);
    } else {
        $('#themeSwitcher').prop('checked', false);
    }
}

$(function () {
    let shrinkHeader = $('header').height();
    $(window).scroll(() => {
        let scroll = getCurrentScroll();
        if (scroll >= shrinkHeader) {
            $('.nav').addClass('shrink');
        }
        else {
            $('.nav').removeClass('shrink');
        }
    });
    function getCurrentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
    }
});

var navigation = $(".nav");
stickyDiv = "sticky";
header = $('header').height();

$(window).scroll(function () {
    if ($(this).scrollTop() > header) {
        navigation.addClass(stickyDiv);
    } else {
        navigation.removeClass(stickyDiv);
    }
});


document.getElementById('themeSwitcher').addEventListener('change', function (event) {
    (event.target.checked) ? updateThemeClass('theme-dark') : updateThemeClass('theme-light')
});

let lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
});