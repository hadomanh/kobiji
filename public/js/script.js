window.addEventListener('load', () => {
    //Initialize Select2 Elements
    $('.select2').select2()

    handleDelete()
})

function handleDelete() {
    const elements = document.querySelectorAll('.deleteItemBtn')

    elements.forEach(element => {
        element.addEventListener('click', () => {
            const url = element.dataset.url
            const method = 'DELETE'
            console.log(url)

            document.getElementById('deleteConfirm').addEventListener('click', ()=> {
                fetch(url, { method })
                .then(() => {
                    location.reload()
                })
            })
        })
    });
}