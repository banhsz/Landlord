// Dynamic thead sticky positioning. Will only work when a single table is on the page
// Very scuffed, but works
$( document ).ready(function() {
    // Get thead and nav element
    var table = $('.table');
    if (table.length > 1) {
        console.log('Sticky table was not set, because there are more than 1 table on the page.');
    } else {
        setTableEvents();
        // Fix thead on pjax success (after pagination). fucking horseshit
        $(document).on('pjax:success', function() {
            $('html, body').animate({
                scrollTop: $("body").offset().top
            }, 0);
            setTableEvents();
        });
    }
});

function setTableEvents() {
    // Table and thead props
    var table = $('.table');
    var tableHead = $(table).children('thead');
    var nav = $('nav');
    tableHead.css('position', 'sticky');
    tableHead.css('top', nav.outerHeight());

    // Add change listener (when menu height changes, update sticky thead position)
    $(nav).on('shown.bs.collapse hidden.bs.collapse', function () {
        tableHead.css('top', nav.outerHeight());
    });
}