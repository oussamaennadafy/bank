<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   </head>
   <body>
    <h1 class='text-center my-5 text-2xl font-semibold'>My Transactions</h1>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-auto w-11/12 md:w-3/4 mt-5">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Liblle
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Recettes
                        </th>
                        <th scope="col" class="px-6 py-3">
                            depenses
                        </th>
                        <th scope="col" class="px-6 py-3">
                            solde
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edit
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    {{-- overlay --}}
    <div id='overlay' class='hidden w-screen h-screen bg-slate-400 opacity-30 fixed top-0 left-0'></div>
    {{-- end overlay --}}

    <!-- edit modal -->
    <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md mx-auto h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button id='close-edit' type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="edit-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
                <div class="py-6 px-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit Transaction</h3>
                    <form class="space-y-5">
                        <div>
                            <label for="libelle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Libelle</label>
                            <input type="libelle" name="libelle" id="libelle" placeholder="Libelle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="recette" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">recette</label>
                            <input type="recette" name="recette" id="recette" placeholder="recette" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="depense" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">depense</label>
                            <input type="depense" name="depense" id="depense" placeholder="deoense" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="solde" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Solde</label>
                            <input type="solde" name="solde" id="solde" placeholder="deoense" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <p class='text-center text-red-600 font-semibold my-2' id='error-msg-edit'></p>
                        <a id='update' class="w-full block cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Transaction</a>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    <!-- end edit modal -->
    {{-- add modal --}}
    <div id="add-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md mx-auto h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button id='close-add' type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="add-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
                <div class="py-6 px-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Add Transaction</h3>
                    <div class='w-1/2 justify-between text-white flex gap-4 rounded-lg bg-slate-700 mx-auto'>
                        <a id='depense-btn' class="px-3 hover:border-slate-800 select-none py-2 bg-slate-600 cursor-pointer border border-slate-800 rounded-full text-center"> depense </a>
                        <a id='recete-btn' class="px-3 select-none py-2 bg-slate-600 cursor-pointer border border-transparent hover:border-slate-800 rounded-full text-center"> recete </a>
                    </div>
                    <form class="space-y-5">
                        <div>
                            <label for="libelle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Libelle</label>
                            <input type="text" name="libelle" id="libelle-add" placeholder="Libelle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div id='depense-input' >
                            <label for="depense" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">depense</label>
                            <input value='0' type="number" name="depense" id="depense-add" placeholder="depense" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div id='recette-input' class='hidden'>
                            <label for="recette" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">recette</label>
                            <input value='0' type="number" name="recette" id="recette-add" placeholder="recette" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="solde" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Solde</label>
                            <input value='0' type="number" name="solde" id="solde-add" placeholder="solde" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <p class='text-center text-red-600 font-semibold my-2' id='error-msg'></p>
                        <a id='submit' onclick="addTransaction()" class="w-full block cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit Transaction</a>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    {{-- end add modal --}}
    <button id='add' class="block mx-auto mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        add transaction +
    </button>

    {{-- <footer class='w-full h-14 bg-gray-200 mt-14 block'>
        <div class='w-full h-full flex justify-center items-center'>
            <p class='text-gray-600 text-center text-sm'>   &copy; 2020 - {{ date('Y') }}</p>   </div>
    </footer> --}}
     

<script src={{ asset('js/main.js') }}></script>
   </body>
   </html>





</x-app-layout>
