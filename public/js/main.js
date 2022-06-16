const  url = 'http://127.0.0.1:8000/api/transactions';

async function read() {
 const row = document.querySelector('tbody');
 let output = '';


fetch(url)
.then(response => response.json())
.then(data => {
 data.forEach(row => {
  // console.log(row);
   const date = row.updated_at;
  output += `
  <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
      <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
        ${date.split('T')[0]}
      </th>
      <td class="px-6 py-4">
          ${row.libelle}
      </td>
      <td class="px-6 py-4">
          ${row.recette}
      </td>
      <td class="px-6 py-4">
          ${row.depense}
      </td>
      <td class="px-6 py-4">
          ${row.solde}
      </td>
      <td class="px-6 py-4">
          <a onclick='editTransaction(${row.id})' class="font-medium cursor-pointer text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
      </td>
      <td class="px-6 py-4">
          <a onclick='deleteTransaction(${row.id})' class="font-medium cursor-pointer text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
      </td>
   </tr>
  `;
 });
 row.innerHTML = output;
})
}



async function editTransaction(id) {
 try{
   // fetch data from api first
   let response = await fetch(url + '/' + id , {method: 'GET'});
   let data = await response.json();
   // console.log(data);

   // set data to form
   const date = data.updated_at;
   // document.querySelector('#date').value = date.split('T')[0];
   document.querySelector('#libelle').value = data.libelle;
   document.querySelector('#recette').value = data.recette;
   document.querySelector('#depense').value = data.depense;
   document.querySelector('#solde').value = data.solde;
   //display html form then
   document.querySelector('#authentication-modal').classList.remove('hidden');
   document.querySelector('#overlay').classList.remove('hidden');

   //close the form
   document.querySelector('#close-edit').addEventListener('click', () => {
    document.querySelector('#authentication-modal').classList.add('hidden');
    document.querySelector('#overlay').classList.add('hidden');
   })

   //update data
   document.querySelector('#update').addEventListener('click', (e) => {
    // const date = document.querySelector('#date').value;
    const libelle = document.querySelector('#libelle').value;
    const recette = document.querySelector('#recette').value;
    const depense = document.querySelector('#depense').value;
    const solde = document.querySelector('#solde').value;
    const transaction = {
     date: date,
     libelle: libelle,
     recette: recette,
     depense: depense,
     solde: solde
    }
    fetch(url + '/' + id , {
     method: 'POST',
     headers: {
      'Content-Type': 'application/json'
     },
     body: JSON.stringify(transaction)
    })
    .then(res => {
     //smooth refresh
     read();
     //close the form
      document.querySelector('#authentication-modal').classList.add('hidden');
      document.querySelector('#overlay').classList.add('hidden');

    })
    .catch(err => console.log(err));
   })

 }catch(err){
   console.error(err);
   // Handle errors here
 }
}


function deleteTransaction(id) {
 fetch(url + '/' + id , {
  method: 'DELETE',
 })
 .then(res => res.json())
  .then(res => read())
  .catch(err => console.log(err));
 }

 read();


 


























// async function loadData() {
//  try{
//   const tableBody = table.querySelector('tbody');
//   let response = await fetch('http://127.0.0.1:8000/api/transactions');
//   let rows = await response.json();

//   // clear the table
//   tableBody.innerHTML = '';

//   //insert the rows
//   for (const row of rows) {
//    const rowElement = document.createElement('tr');

//    for (const cellText of row) {
//     const cellElement = document.createElement('td');

//     cellElement.textContent = cellText;
//     rowElement.appendChild(cellElement);
//    }

//    tableBody.appendChild(rowElement);
//   }
//  }
//  catch(err){
//    console.error(err);
//  }
// }
// loadData();
