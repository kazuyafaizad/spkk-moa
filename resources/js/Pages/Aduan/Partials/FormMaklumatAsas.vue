<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Maklumat Asas</h3>
        </div>
    </div>
    <form>
        <div class="flex flex-wrap mb-4">
            <label
                for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal"
                >Nama Penuh</label
            >
            <div class="sm:w-4/5 pr-4 pl-4">
                <input
                    id="nama"
                    type="text"
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200"
                    placeholder="Mohd Hanif bin Mohd Salleh"
                />
                <!-- <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 " id="colFormLabelSm" placeholder="col-form-label-sm"> -->
            </div>
        </div>
        <div class="flex flex-wrap mb-4">
            <label
                for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal"
                >No. Pengenalan</label
            >
            <div class="sm:w-4/5 pr-4 pl-4">
                <input
                    id="ic"
                    type="text"
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200"
                    placeholder="888888888888"
                />
            </div>
        </div>
        <div class="flex flex-wrap mb-4">
            <label
                for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal"
                >Alamat</label
            >
            <div class="sm:w-4/5 pr-4 pl-4">
                <textarea
                    id="alamat"
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                    rows="3"
                    placeholder="No. C-03-05, ITech Tower Jalan Impact, Cyber 6, 63000 Cyberjaya Selangor"
                ></textarea>
            </div>
        </div>
        <div class="flex flex-wrap mb-4">
            <label
                for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal"
                >No. Telefon</label
            >
            <div class="sm:w-4/5 pr-4 pl-4">
                <input
                    id="telefon"
                    type="text"
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200"
                    placeholder="0172266522"
                />
            </div>
        </div>
        <div class="flex flex-wrap mb-4">
            <label
                for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal"
                >Email</label
            >
            <div class="sm:w-4/5 pr-4 pl-4">
                <input
                    id="email"
                    type="email"
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200"
                    placeholder="hanif@2bytes.com.my"
                />
            </div>
        </div>
    </form>
</template>
