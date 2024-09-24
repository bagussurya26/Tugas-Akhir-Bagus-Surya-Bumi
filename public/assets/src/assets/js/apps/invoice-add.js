// var currentDate = new Date();

// /**
//  * ==================
//  * Single File Upload
//  * ==================
// */

// // We register the plugins required to do 
// // image previews, cropping, resizing, etc.
// FilePond.registerPlugin(
//   FilePondPluginFileValidateType,
//   FilePondPluginImageExifOrientation,
//   FilePondPluginImagePreview,
//   FilePondPluginImageCrop,
//   FilePondPluginImageResize,
//   FilePondPluginImageTransform,
// //   FilePondPluginImageEdit
// );

// Select the file input and use 
// create() to turn it into a pond
// FilePond.create(
//   document.querySelector('.filepond'),
//   {
//     // labelIdle: `<span class="no-image-placeholder"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span> <p class="drag-para">Drag & Drop your picture or <span class="filepond--label-action" tabindex="0">Browse</span></p>`,
//     imagePreviewHeight: 80,
//     imageCropAspectRatio: '1:1',
//     imageResizeTargetWidth: 80,
//     imageResizeTargetHeight: 80,
//     stylePanelLayout: 'compact circle',
//     styleLoadIndicatorPosition: 'center bottom',
//     styleProgressIndicatorPosition: 'right bottom',
//     styleButtonRemoveItemPosition: 'left bottom',
//     styleButtonProcessItemPosition: 'right bottom',
//   }
// );

// var f1 = flatpickr(document.getElementById('basicFlatpickr1'), {
//   dateFormat: "d-m-Y",
//   defaultDate: new Date()
// });

// var f3 = flatpickr(document.getElementById('basicFlatpickr2'), {
//   dateFormat: "d-m-Y",
//   defaultDate: new Date()
// });

// var f2 = flatpickr(document.getElementById('due'), {
//   defaultDate: currentDate.setDate(currentDate.getDate() + 5),
// });

function deleteItemRow() {
    deleteItem = document.querySelectorAll('.delete-item');
    for (var i = 0; i < deleteItem.length; i++) {
        deleteItem[i].addEventListener('click', function () {
            this.parentElement.parentNode.parentNode.parentNode.remove();
        })
    }
}

function selectableDropdown(getElement, myCallback) {
    var getDropdownElement = getElement;
    for (var i = 0; i < getDropdownElement.length; i++) {
        getDropdownElement[i].addEventListener('click', function () {

            var dataValue = this.getAttribute('data-value');
            var dataImage = this.getAttribute('data-img-value');

            if (dataValue === null && dataImage === null) {
                console.warn('No attributes are defined. Kindly define one attribute atleast')
            }

            if (dataValue != '' && dataValue != null) {
                this.parentElement.parentNode.querySelector('.dropdown-toggle > .selectable-text').innerText = dataValue;
            }

            if (dataImage != '' && dataImage != null) {
                this.parentElement.parentNode.querySelector('.dropdown-toggle > img').setAttribute('src', dataImage);
            }

        })
    }
}

function getTaxValue(value) {
    if (value.dropdownValue == 'Deducted') {
        console.log('I am percentage')
        document.querySelector('.tax-rate-deducted').style.display = 'block';
        document.querySelector('.tax-rate-per-item').style.display = 'none';
        document.querySelector('.tax-rate-on-total').style.display = 'none';
    } else if (value.dropdownValue == 'Per Item') {
        console.log('I am Flat Amount')
        document.querySelector('.tax-rate-deducted').style.display = 'none';
        document.querySelector('.tax-rate-per-item').style.display = 'block';
        document.querySelector('.tax-rate-on-total').style.display = 'none';
    } else if (value.dropdownValue == 'On Total') {
        console.log('I am Flat Amount')
        document.querySelector('.tax-rate-deducted').style.display = 'none';
        document.querySelector('.tax-rate-per-item').style.display = 'none';
        document.querySelector('.tax-rate-on-total').style.display = 'block';
    } else if (value.dropdownValue == 'None') {
        console.log('I am None')
        document.querySelector('.tax-rate-deducted').style.display = 'none';
        document.querySelector('.tax-rate-per-item').style.display = 'none';
        document.querySelector('.tax-rate-on-total').style.display = 'none';
    }
}

function getDiscountValue(value) {
    if (value.dropdownValue == 'Percent') {
        console.log('I am percentage')
        document.querySelector('.discount-percent').style.display = 'block';
        document.querySelector('.discount-amount').style.display = 'none';
    } else if (value.dropdownValue == 'Flat Amount') {
        console.log('I am Flat Amount')
        document.querySelector('.discount-amount').style.display = 'block';
        document.querySelector('.discount-percent').style.display = 'none';
    } else if (value.dropdownValue == 'None') {
        console.log('I am None')
        document.querySelector('.discount-percent').style.display = 'none';
        document.querySelector('.discount-amount').style.display = 'none';
    }
}

document.getElementsByClassName('additemtarget')[0].addEventListener('click', function () {
    // console.log('dfdf')

    $html = '<tr>' +
        '<td class="delete-item-row">' +
        '<ul class="table-controls">' +
        '<li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>' +
        '</ul>' +
        '</td>' +
        '<td>' +
        kodeProduks +
        '</td>' +
        '<td width="450px">' +
        namaProduks +
        '</td>' +
        '<td width="200px">' +
        '<select class="form-select"' +
        'id="input-ukuran" name="ukuran">' +
        '<option selected disabled value="">Pilih Ukuran...</option>' +
        ukuranOptions +
        '</select>' +
        '</td>' +
        '<td width="200px">' +
        '<input type="text" value=""' +
        'class="form-control"' +
        'name="qty_pakaian" placeholder="Qty Produk" autofocus>' +
        '</td>' +
        '</tr>';

    $(".target-produksi tbody").append($html);
    deleteItemRow();

})

deleteItemRow();
selectableDropdown(document.querySelectorAll('.invoice-select .dropdown-item'));
selectableDropdown(document.querySelectorAll('.invoice-tax-select .dropdown-item'), getTaxValue);
selectableDropdown(document.querySelectorAll('.invoice-discount-select .dropdown-item'), getDiscountValue);