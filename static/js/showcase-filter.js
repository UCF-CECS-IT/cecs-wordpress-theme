/**
 * Script loaded on Faculty Showcase page. Hides the headshot cards on the 
 * main page according to the filter buttons.
 */
$(document).ready(function() {
    let showAll = document.getElementById('show-all');
    let cece = document.getElementById('show-cece');
    let cs = document.getElementById('show-cs');
    let ece = document.getElementById('show-ece');
    let iems = document.getElementById('show-iems');
    let mse = document.getElementById('show-mse');
    let mae = document.getElementById('show-mae');
    let headshots = document.getElementById('showcase-cards');
    
    showAll.onclick = filterCards;
    cece.onclick = filterCards;
    cs.onclick = filterCards;
    ece.onclick = filterCards;
    iems.onclick = filterCards;
    mse.onclick = filterCards;
    mae.onclick = filterCards;
    
    function filterCards(e) {
        let filter = e.target.dataset.filter;
        switch (filter) {
            case 'all':
                for (let index = 0; index < headshots.childNodes.length; index++) {
                    const element = headshots.childNodes[index];
                    if (element.nodeType == 1) {
                        element.classList.remove('d-none');
                        element.classList.remove('fade');
                    }
                }
                break;
    
            default:
                hideIfNotSelected(headshots.childNodes, filter);
                break;
        }
    }

    function hideIfNotSelected(cards, departmentNumberString) {
        for (let index = 0; index < cards.length; index++) {
            const element = cards[index];
            if (element.nodeType == 1) {
                if (element.dataset.department == departmentNumberString) {
                    element.classList.remove('d-none');
                    element.classList.remove('fade');
                } else {
                    element.classList.add('fade');
                    element.classList.add('d-none');
                }
            }
        }
    }
});