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

function initUpload(uploadSlector, wrap)
{
	function readURL(input) {
		var result = "";

		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
				result = e.target.result;
			  	$(`${wrap} [data-target="${uploadSlector}"][data-content=uploadPreview]`).attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}

		return result;
	}

	$(uploadSlector).change( function(event){
		readURL(this)
		if(this.files && this.files[0]) {
			$(`${wrap} [data-content=uploadPlus]`).hide()
		} else {
			$(`${wrap} [data-content=uploadPlus]`).show()
		}
	})
}

