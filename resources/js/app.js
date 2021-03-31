require('./bootstrap');
require('./ckeditor/ckeditor');

if (document.querySelector('.editor')) {

    ClassicEditor
        .create( document.querySelector( '.editor' ), {
            removePlugins: [ 'WordCount', 'Image', 'ImageToolbar', 'ImageStyle', 'ImageUpload', 'ImageCaption' ],

            toolbar: {
                items: [
                    'bold',
                    'italic',
                    'link',
                    'underline',
                    'strikethrough',
                    'blockQuote',
                    'bulletedList',
                    'numberedList',
                    'todoList',
                    '|',
                    'undo',
                    'redo'
                ]
            },
            language: 'tr',
            licenseKey: '',

        } )
        .then( editor => {
            window.editor = editor;

            console.log(editor.plugins)
        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: 81pdx454i078-mp64eur9cg2k' );
            console.error( error );
        } );
}

let fetchTopics = (url)=>{
    return fetch(url)
        .then((response) => response.json())
        .then((data) => {
            document.querySelector('.topics-holder').innerHTML = data.content;
            let links = document.querySelectorAll('.topics-holder a[rel="next"], .topics-holder a[rel="prev"]');

            links.forEach((link) => {
                link.addEventListener('click', (e)=>{
                    e.preventDefault();

                    let url = e.currentTarget.getAttribute('href');

                    fetchTopics(url);
                })
            });

            document.querySelectorAll('.paginator-select').forEach((select)=>{
                select.addEventListener('change', (e)=>{
                    let url = e.currentTarget.value;
                    fetchTopics(url);
                });
            });
        });
}

if(document.querySelector('.topics-holder')){


    document.querySelector('.refresh-button').addEventListener('click', (e)=>{
        fetchTopics('/i/topics');
    });

    let links = document.querySelectorAll('.topics-holder a[rel="next"], .topics-holder a[rel="prev"]');

    links.forEach((link) => {
        link.addEventListener('click', (e)=>{
            e.preventDefault();

            let url = e.currentTarget.getAttribute('href');

            fetchTopics(url);
        })
    });


    document.querySelectorAll('.paginator-select').forEach((select)=>{
       select.addEventListener('change', (e)=>{
           let url = e.currentTarget.value;
           fetchTopics(url);
       });
    });
}


