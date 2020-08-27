/**
 * Script loaded with the legacy Builder template. Reformats header heights
 * to ensure that two-column headers always have matching heights.
 */
$( window ).ready(function() {
    let rows = document.getElementsByClassName('row no-gutters');

    for (var row of rows) {
        // console.log(row.children);
        let leftHeader = row.children[0].children[0].children[0];
        let rightHeader = row.children[1].children[0].children[0];

        if (leftHeader.scrollHeight > rightHeader.scrollHeight) {
            rightHeader.style.height = leftHeader.scrollHeight + 1 + 'px';
        }

        if (leftHeader.scrollHeight < rightHeader.scrollHeight) {
            leftHeader.style.height = rightHeader.scrollHeight + 1 + 'px';
        }
    }
});  