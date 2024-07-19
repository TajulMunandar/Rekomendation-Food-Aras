import axios from 'axios';
import { Modal } from 'flowbite';

// options with default values
const options = {
    placement: 'bottom-right',
    backdrop: 'dynamic',
    backdropClasses:
        'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
    closable: true,
    onHide: () => {
        console.log('modal is hidden');
    },
    onShow: () => {
        console.log('modal is shown');
    },
    onToggle: () => {
        console.log('modal has been toggled');
    },
};

// instance options object
const instanceOptions = {
  id: 'popup-modal',
  override: true
};

var currentId = null;

const modal = new Modal(document.getElementById('popup-modal'), options, instanceOptions);

document.getElementById('submit-form-tambah-alternatif').addEventListener('click', tambahKriteria);
export function tambahKriteria() {
    document.getElementById('form-tambah-alternatif').submit();
}

document.querySelectorAll('[id*="submit-form-hapus-alternatif"]').forEach(item => {
    const id = item["id"].replace('submit-form-hapus-alternatif-', '');
    item.addEventListener('click', hapusAlternatifModal.bind(this, id), false);
});
document.getElementById('confirm-yes').addEventListener('click', hapusAlternatif);
export function hapusAlternatifModal(id) {
    currentId = id;
    modal.show();
}

function hapusAlternatif() {
    document.getElementById('form-hapus-alternatif-' + currentId).submit();
}

document.querySelectorAll('[id*="edit-alternatif-"]').forEach(item => {
    const id = item["id"].replace('edit-alternatif-', '');
    item.addEventListener('click', editAlternatifModal.bind(this, id), false);
});

export function editAlternatifModal(id) {
    currentId = id;
    axios.post('/api/alternatif/getdata', {
        kode: id
    }).then(response => {
        console.log(response.data);
        document.getElementById('edit_kode_alternatif').value = response.data.kode;
        document.getElementById('edit_nama_alternatif').value = response.data.nama;
    }).catch(error => {
        alert(error);
    });
}

document.getElementById("submit-form-edit-alternatif").addEventListener('click', editAlternatif)
export function editAlternatif() {
    document.getElementById('form-edit-alternatif').submit();
}