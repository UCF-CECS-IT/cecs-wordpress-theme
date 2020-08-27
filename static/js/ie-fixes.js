if (document.documentMode) {
    console.log('in document mode');

    $( window ).ready(function() {
        let usingObjectFit = document.getElementsByClassName('object-fit-cover');

        // for (let index = 0; index < usingObjectFit.length; index++) {
        //     const element = usingObjectFit[index];

        //     if (!element.classList.contains('media-background')) {
        //         element.classList.add('ie-wrap-fix');
        //     }
        // }
    });    
}
