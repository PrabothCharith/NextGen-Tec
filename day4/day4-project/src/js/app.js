testFunction2();

let testVariable = 1;
function testFunction() {
    console.log('testFunction is working. testVariable:', testVariable);
    testVariable++;
}

function testFunction2() {
    // Remove this alert before using if you don't want to see it every time you refresh the page
    alert('Page is loaded, check console for testFunction output');
}