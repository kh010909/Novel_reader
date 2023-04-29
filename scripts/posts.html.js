/* Script from https://www.w3schools.com/howto/howto_js_navbar_hide_scroll.asp */
var prev_scroll_pos = window.pageYOffset || document.documentElement.scrollTop;

function navbar_scroll() {
    let current_scroll_pos = get_current_scroll();
    if (current_scroll_pos > 1)
        document.getElementById("posts-navbar").classList.add("nav-bg-black");
    else
        document.getElementById("posts-navbar").classList.remove("nav-bg-black");

    if (current_scroll_pos < document.getElementById("posts-topic").offsetHeight) {
        document.getElementById("posts-navbar").style.top = "0";
        return;
    }

    if (prev_scroll_pos < current_scroll_pos)
        document.getElementById("posts-navbar").style.top = `-${document.getElementById("posts-navbar").offsetHeight}px`;
    else
        document.getElementById("posts-navbar").style.top = "0";


    prev_scroll_pos = current_scroll_pos;
}

function get_current_scroll() {
    return window.pageYOffset || document.documentElement.scrollTop;
}

window.onscroll = navbar_scroll;