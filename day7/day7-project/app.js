function test() {
    alert('Hello, World!');
}


// Snow script included on the page, already.
window.onload = function () {
    var snow = new Snow.default({
        id: 'snow'
    });

    //Can run the snowfall by calling:
    snow.start();
}