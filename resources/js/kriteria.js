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

document.getElementById('submit-form-tambah-kriteria').addEventListener('click', tambahKriteria);
export function tambahKriteria() {
    document.getElementById('form-tambah-kriteria').submit();
}

document.querySelectorAll('[id*="submit-form-hapus-kriteria"]').forEach(item => {
    const id = item["id"].replace('submit-form-hapus-kriteria-', '');
    item.addEventListener('click', hapusKriteriaModal.bind(this, id), false);
});
document.getElementById('confirm-yes').addEventListener('click', hapusKriteria);
export function hapusKriteriaModal(id) {
    currentId = id;
    modal.show();
}

function hapusKriteria() {
    document.getElementById('form-hapus-kriteria-' + currentId).submit();
}

document.querySelectorAll('[id*="edit-kriteria-"]').forEach(item => {
    const id = item["id"].replace('edit-kriteria-', '');
    item.addEventListener('click', editKriteriaModal.bind(this, id), false);
});

export function editKriteriaModal(id) {
    currentId = id;
    axios.post('/api/kriteria/getdata', {
        id: id
    }).then(response => {
        document.getElementById('edit_kode_kriteria').value = response.data.kode;
        document.getElementById('edit_nama_kriteria').value = response.data.nama;
        document.getElementById('edit_bobot_kriteria').value = response.data.bobot;

        if (response.data.atribut == "cost") {
            document.getElementById('edit_atribut').selectedIndex = 1;
        }else{
            document.getElementById('edit_atribut').selectedIndex = 0;
        }
    }).catch(error => {
        alert(error);
    });
}

document.getElementById("submit-form-edit-kriteria").addEventListener('click', editKriteria)
export function editKriteria() {
    document.getElementById('form-edit-kriteria').submit();
}






