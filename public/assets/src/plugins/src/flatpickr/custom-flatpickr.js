// Flatpickr

var f1 = flatpickr(document.getElementById('basicFlatpickr1'), {
    dateFormat: "d-m-Y",
    defaultDate: new Date()
});

var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    defaultDate: new Date()
});
var f3 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
    mode: "range",
});
var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "13:45",
});
var f5 = flatpickr(document.getElementById('monthCalendarFlatpickr'), {
    disableMobile: "true",
    plugins: [
        new monthSelectPlugin({
            shorthand: true,
            dateFormat: "m/Y",
            altFormat: "F Y",
            theme: "material_blue"
        })
    ]
});