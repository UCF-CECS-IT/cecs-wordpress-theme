// Handles filtering on directory search page

(function ($) {

    const $table = $('#directory-table');
    const $search = $('#staffSearch');
    const $reset = $('#reset-search');

    function resetTable() {
        let tableBody = $table.get(0).children[1];

        // Reset search value
        $search.get(0).value = '';

        // Un-hide all rows
        for (let index = 0; index < tableBody.children.length; index++) {
            const row = tableBody.children[index];
            row.classList.remove('d-none');
        }
    }

    function filterDirectory() {
        let searchTerm = $search.get(0).value;
        let tableBody = $table.get(0).children[1];
        console.log(searchTerm);

        for (let index = 0; index < tableBody.children.length; index++) {
            const row = tableBody.children[index];

            if (hasMatch(row, searchTerm)) {
                row.classList.remove('d-none');
            } else {
                row.classList.add('d-none');
            }
        }
    }

    function hasMatch(row, term) {
        for (let index = 0; index < row.children.length; index++) {
            const cell = row.children[index];

            // case-insensitive search
            let regex = new RegExp(term, 'i')

            if (cell.innerText.match(regex)) {
                return true;
            }
        }

        return false;
    }

    function init() {
        if ($table.length && $search.length) {
            // keyup
            $search.get(0).onkeyup = filterDirectory;
            $reset.get(0).onclick = resetTable;
        }
    }

    $(init);


}(jQuery));
