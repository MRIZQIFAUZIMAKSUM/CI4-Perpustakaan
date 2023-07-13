const books = [];
const RENDER_EVENT = 'render-book';
const SAVED_EVENT = 'saved-book';
const EDIT_EVENT = 'edit-book';
const STORAGE_KEY = 'BOOK_APPS';
document.addEventListener('DOMContentLoaded', function () {
   // animasi preloader, animasi fade out akan dijalankan setelah 0.5 detik
  setTimeout(() => {
    document.getElementById('preloader').style.animationName = "fadeOut";
    document.getElementById('preloader').style.animationDuration = "0.5s";
  }, 500);
  // setelah 1 detik baru preloader akan dihilangkan
  setTimeout(() => {
    document.getElementById('preloader').style.display = 'none';
  }, 999);
  const addForm /* HTMLFormElement */ = document.getElementById('add-book');
  addForm.addEventListener('submit', function (event) {
    event.preventDefault();
    if (cek.checked == true) {
      document.getElementById("inputBookIsComplete").value = "true";
      console.log(document.getElementById("inputBookIsComplete").value);
    } else {
      document.getElementById("inputBookIsComplete").value = "false";
      console.log(document.getElementById("inputBookIsComplete").value);
    }
    addBook();
  });

  if (isStorageExist()) {
    loadDataFromStorage();
  }
});
// variable ini untuk memunculkan , menghilangkan dan mengedit modal
var modal = document.getElementById("BookModal");
var btnmodaladd = document.getElementById("btn-add-book");
var btnclose = document.getElementsByClassName("btn-close")[0];
var btn1 = document.getElementById("btn-1");
var btn2 = document.getElementById("btn-2");

var modalheader = document.getElementById("modal-header");
var modalTitle = document.getElementsByClassName("modal-title")[0];
var formDialog = document.getElementById("form-dialog");
var confirmDialog = document.getElementById("confirm-dialog");
var modal_content = document.getElementById("modalcontent");
// untuk menghilangkan modal tambah dan edit dengan animasi
function hide() {
  console.log("memulai animasi");
  modal_content.style.top = "21%";
  modal.style.animationName = "fadeOut";
  modal.style.animationDuration = "0.4s";
  modal_content.style.animationName = "slideOut";
  modal_content.style.animationDuration = "0.4s";
  //setelah timeout display none 
  setTimeout(() => {
    console.log("selesai dan mengembalikan animasi");
    modal.style.animationName = "fadeIn";
    modal.style.animationDuration = "0.4s";
    modal.style.display = "none";
  }, 399);
  console.log("melakukan animasi");
}
//menjalankan fungsi untuk memunculkan modal tambah buku
btnmodaladd.onclick = function (e) {
  modal_content.style.top = "21%";
  modalTitle.innerText = "Tambah Buku";
  modalheader.classList.remove("bg-danger");
  formDialog.style.display = "block";
  confirmDialog.style.display = "none";
  btn1.innerText = "Tambah";
  btn1.classList.remove('btn-light');
  btn1.classList.add('btn-success')
  btn2.innerHTML = "Batal";

  var $_title = document.getElementById("c-title");
  var $_author = document.getElementById("c-author");
  var $_penerbit = document.getElementById("c-penerbit");
  var $_year = document.getElementById("c-year");
  var $_check = document.getElementById("inputBookIsComplete");
  var $_getValidationField = document.getElementsByClassName("validation-text");

  $_title.value = "";
  $_author.value = "";
  $_penerbit.value = "";
  $_year.value = 2016;
  if ($_check.checked) {
    $_check.checked = false;
  }

  for (var i = 0; i < $_getValidationField.length; i++) {
    e.preventDefault();
    $_getValidationField[i].style.display = "none";
  }

  modal_content.style.animationName = "slideIn";
  modal_content.style.animationDuration = "0.4s";
  //setelah timeout baru memunculkan modal
  setTimeout(() => {
    console.log("selesai");
    modal.style.display = "block";
  }, 1);
  btn1.setAttribute('type', 'submit')
  btn1.onclick = function () {
  };
  btn2.onclick = function () {
    hide()
  };
  btnclose.onclick = function () {
    hide()
  };
  window.onclick = function (event) {
    if (event.target == modal) {
      hide();
    }
  }
}
//modal edit
function btnmodaledit(book) {
  modal_content.style.top = "21%";
  modalTitle.innerText = "Edit Buku";
  modalheader.classList.remove("bg-danger");
  formDialog.style.display = "block";
  confirmDialog.style.display = "none";
  btn1.innerText = "Edit";
  btn1.classList.remove('btn-light');
  btn1.classList.add('btn-success')
  btn2.innerHTML = "Batal";

  var $_title = document.getElementById("c-title");
  var $_author = document.getElementById("c-author");
  var $_penerbit = document.getElementById("c-penerbit");
  var $_year = document.getElementById("c-year");
  var $_check = document.getElementById("inputBookIsComplete");
  var $_getValidationField = document.getElementsByClassName("validation-text");

  $_title.value = book.title;
  $_author.value = book.author;
  $_penerbit.value = book.penerbit;
  $_year.value = book.year;
  $_check.checked = book.isCompleted;

  for (var i = 0; i < $_getValidationField.length; i++) {
    $_getValidationField[i].style.display = "none";
  }

  modal_content.style.animationName = "slideIn";
  modal_content.style.animationDuration = "0.4s";
  //setelah timeout baru memunculkan modal
  setTimeout(() => {
    console.log("selesai");
    modal.style.display = "block";
  }, 1);
  btn1.setAttribute('type', 'button')
  btn1.onclick = function () {
    hide();
    setTimeout(() => {
      var id = book.id;
      // mekanika edit adalah mecari id yang sama dari object book yang didapat dari array books kemudian menggantinya dengan value baru dan mensave nya lalu 
      // me render halaman kembali, disini saya tidak menggunakan fungsi
      for (const book of books) {
        switch (id) {
          case book.id:
            book.title = document.getElementById("c-title").value;
            book.author = document.getElementById("c-author").value;
            book.penerbit = document.getElementById("c-penerbit").value;
            book.year = document.getElementById("c-year").value;
            book.isCompleted = document.getElementById("inputBookIsComplete").checked;
          default:
            console.log('bukan');
        }
      }
      document.dispatchEvent(new Event(EDIT_EVENT));
      const parsed /* string */ = JSON.stringify(books);
      localStorage.setItem(STORAGE_KEY, parsed);
      document.dispatchEvent(new Event(RENDER_EVENT));
    }, 400);
  };
  btn2.onclick = function () {
    hide()
  };
  btnclose.onclick = function () {
    hide()
  };
  window.onclick = function (event) {
    if (event.target == modal) {
      hide();
    }
  }
}
//fungsi untuk menyembunyikan modal delete dengan animasi 
function hidedelete() {
  console.log("memulai animasi");
  modal.style.animationName = "fadeOut";
  modal.style.animationDuration = "0.4s";
  //setelah timeout display none 
  setTimeout(() => {
    console.log("selesai dan mengembalikan animasi");
    modal.style.animationName = "fadeIn";
    modal.style.animationDuration = "0.4s";
    modal.style.display = "none";
  }, 399);
  console.log("melakukan animasi");
}
//modal delete
function btnmodaldelete(id) {
  modal_content.style.top = "26%";
  modalTitle.innerText = "Konfirmasi Hapus";
  modalheader.classList.add("bg-danger")
  formDialog.style.display = "none";
  confirmDialog.style.display = "block";
  btn1.innerText = "Batal";
  btn1.classList.remove('btn-success');
  btn1.classList.add('btn-light')
  btn2.innerHTML = "Hapus";

  console.log("memulai animasi");
  modal_content.style.animationName = "popup";
  modal_content.style.animationDuration = "0.7s";
  //setelah timeout baru memunculkan modal
  setTimeout(() => {
    console.log("selesai");
    modal.style.display = "block";
  }, 1);
  console.log("melakukan animasi");
  btn1.setAttribute('type', 'button')
  btn1.onclick = function () {
    hidedelete()
  };
  btn2.onclick = function () {
    //delete dari local storage
    hidedelete();
    setTimeout(() => {
      const bookTarget = findBookIndex(id);
      if (bookTarget === -1) return;
      books.splice(bookTarget, 1);
      document.dispatchEvent(new Event(RENDER_EVENT));
      document.dispatchEvent(new Event(SAVED_EVENT));
    }, 400);
  };
  btnclose.onclick = function () {
    hidedelete();
  };
  window.onclick = function (event) {
    if (event.target == modal) {
      hidedelete();
    }
  }
}
var selectedIdC = document.getElementsByClassName("selected-id-c");
var selectedIdU = document.getElementsByClassName("selected-id-u");
function deleteselectedU() {
  for (id of selectedIdU) {
    if (id.checked) {
      const bookTarget = findBookIndex(id.value);
      if (bookTarget === -1) return;
      books.splice(bookTarget, 1);
    }
  }
  checkallU.checked = false;
  document.dispatchEvent(new Event(RENDER_EVENT));
  document.dispatchEvent(new Event(SAVED_EVENT));
}
function deleteselectedC() {
  for (id of selectedIdC) {
    if (id.checked) {
      const bookTarget = findBookIndex(id.value);
      if (bookTarget === -1) return;
      books.splice(bookTarget, 1);
    }
  }
  checkallC.checked = false;
  document.dispatchEvent(new Event(RENDER_EVENT));
  document.dispatchEvent(new Event(SAVED_EVENT));
}
function moveToCompleted() {
  for (id of selectedIdU) {
    if (id.checked) {
      const bookTarget = findBook(id.value);
      console.log(bookTarget)
      if (bookTarget == null) return;
    
      bookTarget.isCompleted = true;
    }
  }
  checkallU.checked = false;
  document.dispatchEvent(new Event(RENDER_EVENT));
  document.dispatchEvent(new Event(SAVED_EVENT));
}
function moveToUncompleted() {
  for (id of selectedIdC) {
    console.log(id.checked);
    if (id.checked) {
      console.log(id.value);
      const bookTarget = findBook(id.value);
      console.log(bookTarget)
      if (bookTarget == null) return;
    
      bookTarget.isCompleted = false;
    }
  }
  checkallC.checked = false;
  document.dispatchEvent(new Event(RENDER_EVENT));
  document.dispatchEvent(new Event(SAVED_EVENT));
}
// mengubah value checkbox apabila di tekan
var cek = document.getElementById("inputBookIsComplete");

var checkallU = document.getElementById("check-all-u");
checkallU.addEventListener('change', function () {
  if (this.checked == true) {
    for (id of selectedIdU) {
      id.checked = true;
    }
  } else {
    for (id of selectedIdU) {
      id.checked = false;
    }
  }
});
var checkallC = document.getElementById("check-all-c");
checkallC.addEventListener('change', function () {
  if (this.checked == true) {
    for (id of selectedIdC) {
      id.checked = true;
    }
  } else {
    for (id of selectedIdC) {
      id.checked = false;
    }
  }
});
// footer 
var date = new Date().getFullYear();
document.getElementById("this-year").innerHTML = date;

function generateId() {
  // saya menggunakan math random dan substring untuk membuat id sepanjang 7 angka dan tulisan
  return (Math.random() + 1).toString(36).substring(2);
}

function generateBookObject(id, title, author, year, penerbit, isCompleted) {
  return {
    id, title, author, year, penerbit, isCompleted
  }
}

/**
 * fungsi ini berfungsi mencari buku dan mengembalikan object bookitem yang akan digunakan 
 * pada tambah buku ke list buku selesai dibaca dan pada undo buku dari list selesai ke list belum selesai
 * 
 */
function findBook(bookId) {
  for (const bookItem of books) {
    if (bookItem.id === bookId) {
      return bookItem;
    }
  }
  return null;
}
/**
 * fungsi ini berfungsi mencari buku dan mengembalikan index nya digunakan untuk menghapus buku
 * 
 */
function findBookIndex(bookId) {
  for (const index in books) {
    if (books[index].id === bookId) {
      return index;
    }
  }
  return -1;
}

/**
 * Fungsi ini digunakan untuk memeriksa apakah localStorage didukung oleh browser atau tidak
 *
 * @returns boolean
 */
function isStorageExist() /* boolean */ {
  if (typeof (Storage) === undefined) {
    alert('Browser kamu tidak mendukung local storage');
    return false;
  }
  return true;
}

/**
 * Fungsi ini digunakan untuk memuat data dari localStorage
 * Dan memasukkan data hasil parsing ke variabel {@see todos}
 */
function loadDataFromStorage() {
  const serializedData /* string */ = localStorage.getItem(STORAGE_KEY);
  let data = JSON.parse(serializedData);
  if (data !== null) {
    for (const book of data) {
      books.push(book);
    }
  }
  document.dispatchEvent(new Event(RENDER_EVENT));
}

function makeBook(bookObject) {
  const { id, title, author, year, penerbit, isCompleted } = bookObject;

  const selectedId = document.createElement('td');

  const bookAuthor = document.createElement('td');
  bookAuthor.innerHTML = `<span class="text-muted"> ${author}</span>`;

  const bookYear = document.createElement('td');
  bookYear.innerHTML = '<span class="text-muted">' + year + "</span>";

  const bookTitle = document.createElement('td');
  const containeraction = document.createElement('td');
  const action = document.createElement('div');
  action.classList.add("action", "action-btn");

  const bookContainer = document.createElement('tr');
  bookContainer.setAttribute('id', bookObject.id);
  const bookCheck = document.getElementById("inputBookIsComplete").value;
  bookContainer.append(selectedId, bookTitle, bookAuthor, bookYear, containeraction);
  if (!bookCheck.checked) {
    const incompleteBook = document.getElementById('incompleteBookshelfList');

    incompleteBook.append(bookContainer);
  } else {
    const completeBook = document.getElementById('completeBookshelfList');

    completeBook.append(bookContainer);
  }
  const edit = document.createElement('a');
  edit.href = 'javascript:void(0)';
  edit.classList.add('text-info', 'me-2');
  edit.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
  edit.addEventListener('click', function () {
    btnmodaledit(bookObject);
  });
  if (isCompleted) {
    const undoButton = document.createElement('a');
    undoButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">' +
      '<path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>' +
      '</svg>';
    undoButton.href = "javascript:void(0)";
    undoButton.classList.add('text-success', 'me-2');

    undoButton.addEventListener('click', function () {
      undoBookFromCompleted(bookObject.id);
    });

    const deleteButton = document.createElement('a');
    deleteButton.innerHTML = '<svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>';
    deleteButton.classList.add('text-danger',);
    deleteButton.href = "javascript:void(0)";
    deleteButton.addEventListener('click', function () {
      btnmodaldelete(bookObject.id);
    });
    bookTitle.innerHTML =
      '<div class="d-flex align-items-center">' +
      '<span class="round flex-shrink-0 rounded-circle text-white d-inline-block text-center bg-book" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book feather-sm"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg></span>' +
      '<div class="ms-3">' +
      '<h4 class="mb-0" >' + title + "</h4>" +
      '<small class="text-muted">' + penerbit + '</small>' +
      "</span>" +
      "</div>" +
      "</div>";

    bookContainer.classList.add('completebooks');
    selectedId.innerHTML = `<div class="align-self-center text-center"><input type="checkbox" class="form-check-input secondary selected-id-c" value=${id}></div>`;
    action.append(edit, undoButton, deleteButton);
    containeraction.append(action)
  } else {
    const checkButton = document.createElement('a');
    checkButton.innerHTML = ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">' +
      '<path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>'
    checkButton.href = "javascript:void(0)";
    checkButton.classList.add('text-success', 'me-2');
    checkButton.addEventListener('click', function () {
      addBookToCompleted(bookObject.id);
    });
    const deleteButton = document.createElement('a');
    deleteButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>';
    deleteButton.classList.add('text-danger',);
    deleteButton.href = "javascript:void(0)";
    deleteButton.addEventListener('click', function () {
      btnmodaldelete(bookObject.id);
    });
    bookTitle.innerHTML =
      '<div class="d-flex align-items-center">' +
      '<span class="round flex-shrink-0 rounded-circle  text-white d-inline-block text-center bg-book" > <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open feather-sm"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg></span>' +
      '<div class="ms-3">' +
      '<h4 class="mb-0" >' + title + "</h4>" +
      '<small class="text-muted">' + penerbit + '</small>' +
      "</div>" +
      "</div>";
    bookContainer.classList.add('incompletebooks');
    selectedId.innerHTML = `<div class="align-self-center text-center"><input type="checkbox" class="form-check-input secondary selected-id-u" value=${id}></div>`;

    action.append(edit, checkButton, deleteButton);
    containeraction.append(action)
  }

  return bookContainer;
}

function addBook() {
  if (btn1.disabled == true) {
  }
  else {
    const bookTitle = document.getElementById('c-title').value;
    const bookAuthor = document.getElementById('c-author').value;
    const bookYear = parseInt(document.getElementById('c-year').value);
    const bookPenerbit = document.getElementById('c-penerbit').value;
    const bookCek = document.getElementById("inputBookIsComplete").value;
    const generatedID = generateId();
    let cek = false;
    if (bookCek == "true") {
      cek = true
    }
    const bookObject = generateBookObject(generatedID, bookTitle, bookAuthor, bookYear, bookPenerbit, cek);
    books.push(bookObject);

    document.dispatchEvent(new Event(RENDER_EVENT));
    document.dispatchEvent(new Event(SAVED_EVENT));
    hide();
  }
}

function addBookToCompleted(bookId /* HTMLELement */) {
  const bookTarget = findBook(bookId);

  if (bookTarget == null) return;

  bookTarget.isCompleted = true;
  document.dispatchEvent(new Event(RENDER_EVENT));

  document.dispatchEvent(new Event(SAVED_EVENT));
}


function undoBookFromCompleted(bookId /* HTMLELement */) {

  const bookTarget = findBook(bookId);
  console.log(bookTarget)
  if (bookTarget == null) return;

  bookTarget.isCompleted = false;
  document.dispatchEvent(new Event(RENDER_EVENT));

  document.dispatchEvent(new Event(SAVED_EVENT));
}
/**
 * Saved_event ini digunakan untuk menyimpan data ke localStorage berdasarkan KEY yang sudah ditetapkan sebelumnya.
 */
document.addEventListener(SAVED_EVENT, () => {
  if (isStorageExist()) {
    const parsed /* string */ = JSON.stringify(books);
    localStorage.setItem(STORAGE_KEY, parsed);
    console.log('Data berhasil di simpan.');
  }
});

document.addEventListener(EDIT_EVENT, () => {
  console.log('Edit Sukses');
});

document.addEventListener(RENDER_EVENT, function () {
  const uncompletedBOOKList = document.getElementById('incompleteBookshelfList');
  const listCompleted = document.getElementById('completeBookshelfList');
  // clearing list item
  uncompletedBOOKList.innerHTML = '';
  listCompleted.innerHTML = '';
  i = 0;
  for (const bookItem of books) {
    const bookElement = makeBook(bookItem);
    if (bookItem.isCompleted) {
      listCompleted.append(bookElement);
    } else {
      uncompletedBOOKList.append(bookElement);
    }
    i++;
  }
  document.getElementById('total').innerText = i;
})

document.getElementById("input-search-c").addEventListener("keyup", function () {
  // disini saya mencoba tidak menggunakan regular expression 
  const completedBOOKList = document.getElementById('completeBookshelfList');
  var findBooks = [];
  for (const book of books) {
    if (book.isCompleted) {
      // disini saya mencoba mencarinya menggunakan switch case sedethana
      // jadi apabila keyword ditemukan di judul maka tambah findbooks ,lanjut kemudian apabila keyword ditemukan di penulis maka tambah findbooks dan seterusnya 
      switch (this.value) {
        case (book.title):
          findBooks.push(book);
          break; //apabila tidak ada break maka akan terjadi duplikasi 
        case (book.author):
          findBooks.push(book);
          break;
        case (book.year):
          findBooks.push(book);
          break;
        case (book.penerbit):
          findBooks.push(book);
          break;
        default:
      }
      //namun disini ada bug lagi yaitu apabila judul atau author atau kolom manapun yang mempunyai keyword yang sama akan terjadi duplikasi data hasil pencarian
      // oleh karena itu kita pakai break ;
    }
  }

  //setalah muncul hasil akhirnya tidak peduli itu false atau true data yang sudah didapat akan dimasukan ke findbooks jadi ada data di findbooks 
  //maka akan memunculkan data hasil pencariannya apabila tidak yaitu hasilnya false terus maka akan mengosongkan tabelnya
  if (findBooks !== null) {
    //namun ada satu kondisi yaitu apabila user tidak memasukan data apapun maka hasilnya akan true, oleh karena itu harus kita handle dan juga apabila sudah selesai melakukan pencarian 
    //maka user akan menghapus keyword pencarian dan berharap semua data akan kembali, sehingga kita perlu mengembalikan semua datanya
    if (this.value == "") {
      completedBOOKList.innerHTML = '';
      for (const book of books) {
        if (book.isCompleted) {
          const bookElement = makeBook(book);
          completedBOOKList.append(bookElement);
        }
      }
    } else {
      // mengeluarkan hasil pencarian
      completedBOOKList.innerHTML = '';
      for (const book of findBooks) {
        const bookElement = makeBook(book);
        completedBOOKList.append(bookElement);
      }
    }
  } else {
    // hasil pencarian kosong
    completedBOOKList.innerHTML = '';
  }
});
document.getElementById("input-search-u").addEventListener("keyup", function () {
  // disini saya menggunakan regular expression agar pencariannya berdasarkan keyword jadi tidak perlu sampai selesai mengetik hasil sudah ada dengan fungsi rex.test()
  var rex = new RegExp(this.value, "i");
  const uncompletedBOOKList = document.getElementById('incompleteBookshelfList');
  var findBooks = [];
  for (const book of books) {
    if (!book.isCompleted) {
      /**berbeda dengan cara pencarian sebelumnya  disini saya tidak menggunakan switch case, namun saya menggunakan fungsi test() yang ada di regular expression 
       * dan menggunakan operator OR untuk memasukan semua data yang dicari ke dalam 1 parameter jadi operatorasi dibawah bisa dibaca 
       * keyword akan dicari pada judul atau penulis atau tahun atau penerbit sehingga pencariannya tidak hanya mencari di satu kolom 
       */
      hasil = rex.test(book.title) || rex.test(book.author) || rex.test(parseInt(book.year)) || rex.test(book.penerbit);
      /** hasil yang bisa terjadi 
       * true || true || true || true => true
       * false || true || true || true => true
       * true || false || true || true => true
       * true || true || false || true => true
       * true || true || true || false => true
       * 
       * false || false || true || true => true
       * true || false || false || true => true
       * true || true || false || false => true
       * false || true || true || false => true
       * 
       * false || false || false || true => true
       * true || false || false || false => true
       * false || false || false || false => false
       */
      console.log(hasil);
      if (hasil == true) {
        findBooks.push(book);
      }
      //namun disini ada sedikit bug yaitu apabila kita memasukan kata penerbit1 di kolom penerbit lalu mencarinya dengan keyword pener maka hasilnya false seharusnya true

    }
  }
  //setalah muncul hasil akhirnya tidak peduli itu false atau true data yang sudah didapat akan dimasukan ke findbooks jadi ada data di findbooks 
  //maka akan memunculkan data hasil pencariannya apabila tidak yaitu hasilnya false terus maka akan mengosongkan tabelnya  
  if (findBooks !== null) {
    //namun ada satu kondisi yaitu apabila user tidak memasukan data apapun maka hasilnya akan true, oleh karena itu harus kita handle dan juga apabila sudah selesai melakukan pencarian 
    //maka user akan menghapus keyword pencarian dan berharap semua data akan kembali, sehingga kita perlu mengembalikan semua datanya
    if (this.value == "") {
      uncompletedBOOKList.innerHTML = '';
      for (const book of books) {
        if (!book.isCompleted) {
          const bookElement = makeBook(book);
          uncompletedBOOKList.append(bookElement);
        }
      }
    } else {
      // mengeluarkan hasil pencarian
      uncompletedBOOKList.innerHTML = '';
      for (const book of findBooks) {
        const bookElement = makeBook(book);
        uncompletedBOOKList.append(bookElement);
      }
    }
  } else {
    // hasil pencarian kosong
    uncompletedBOOKList.innerHTML = '';
  }
});

// Validasi pada form tambah buku

var $_getValidationField = document.getElementsByClassName("validation-text");

getTitleInput = document.getElementById("c-title");

getTitleInput.addEventListener("input", function () {
  getTitleInputValue = this.value;

  if (getTitleInputValue == "") {
    $_getValidationField[0].innerHTML = "Judul Harus ada";
    $_getValidationField[0].style.display = "block";
    btn1.disaled = true;
  } else {
    $_getValidationField[0].style.display = "none";
    btn1.disaled = false;
  }
});

getauthorInput = document.getElementById("c-author");

getauthorInput.addEventListener("input", function () {
  getauthorInputValue = this.value;

  if (getauthorInputValue == "") {
    $_getValidationField[1].innerHTML = "Penulis Harus Ada";
    $_getValidationField[1].style.display = "block";
    btn1.disaled = true;
  } else {
    $_getValidationField[1].style.display = "none";
    btn1.disaled = false;
  }
});

getYearInput = document.getElementById("c-year");

getYearInput.addEventListener("input", function () {
  getYearInputValue = this.value;

  if (getYearInputValue == "") {
    $_getValidationField[2].innerHTML = "Tahun Terbit Harus Ada";
    $_getValidationField[2].style.display = "block";
    btn1.disaled = true;
  } else {
    $_getValidationField[2].style.display = "none";
    btn1.disaled = false;
  }
});
getPenerbitInput = document.getElementById("c-penerbit");

getPenerbitInput.addEventListener("input", function () {
  getPenerbitInputValue = this.value;

  if (getPenerbitInputValue == "") {
    $_getValidationField[3].innerHTML = "Penerbit Harus Ada";
    $_getValidationField[3].style.display = "block";
    btn1.disaled = true;
  } else {
    $_getValidationField[3].style.display = "none";
    btn1.disaled = false;
  }
});