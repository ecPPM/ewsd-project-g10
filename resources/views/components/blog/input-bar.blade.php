<div class="fixed bottom-6 flex flex-col">
    <form wire:submit.prevent="savePost">
        <textarea wire:model="editingText" class="w-full border rounded-lg p-2 focus:outline-none focus:ring focus:border-blue-300" rows="2" placeholder="Type your message here..."></textarea>
        <div class="flex justify-between">
            <input type="file" wire:model="files" class="file-input file-input-bordered file-input-sm w-full max-w-xs" multiple/>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Send
            </button>
        </div>
    </form>
</div>
