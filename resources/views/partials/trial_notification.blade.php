<div class="bg-teal-500 px-6 py-4 rounded-lg">
    <div class="flex">
        <svg width="40px" height="40px" class="fill-current text-white mr-4" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" stroke="none" stroke-width="1"><g id="noun_Countdown_50361"><path d="M16.821 6.174c-.465-.301-.775-.15-.93 0l-3.879 3.52c-.572-.104-1.153.007-1.547.39-.62.6-.62 1.653 0 2.405.08.078.186.117.28.176l.34 3.734c0 .3.155.601.775.601.465 0 .775-.451.775-.601l.234-3.87c.025-.016.053-.022.076-.04.388-.47.504-1.048.408-1.568l3.468-3.845c.155-.15.31-.602 0-.902zM30.5 11c.9 0 1.5-.64 1.5-1.6V4.6c0-.96-.6-1.6-1.5-1.6S29 3.64 29 4.6v4.8c0 .96.6 1.6 1.5 1.6z" id="Path"/><path d="M0 11.5C0 17.787 5.213 23 11.5 23S23 17.787 23 11.5 17.787 0 11.5 0C9.353 0 7.36.613 5.673 1.533c.614 0 1.074.307 1.38.614.307.306.46.766.614 1.226 1.226-.613 2.453-.92 3.833-.92 4.907 0 9.047 3.987 9.047 9.047 0 4.907-3.987 9.047-9.047 9.047-4.897 0-9.03-3.972-9.045-9.018.055-.015.095-.012.152-.029 0-2.76 1.226-3.833 1.226-3.833L5.06 8.74c.153.153.307.153.46.153a.33.33 0 00.307-.306c.46-2.147.306-4.907.306-5.06 0-.154-.153-.307-.153-.307-.153-.153-.153-.153-.307-.153-.153 0-2.76-.154-5.213.306a.33.33 0 00-.307.307c0 .153 0 .46.154.46l1.38 1.227S1.27 6.007.87 7.15C.297 8.456 0 9.927 0 11.5z" id="Path"/><path id="Rectangle" d="M17 31h3v3h-3zM11 25h3v3h-3zM11 31h3v3h-3zM23 25h3v3h-3zM23 31h3v3h-3zM23 19h3v3h-3z"/><path d="M35.375 6h-1.542v3.105c0 1.708-1.387 3.105-3.083 3.105-1.696 0-3.083-1.397-3.083-3.105V6H23.35c.77 1.708 1.233 3.57 1.233 5.434 0 1.397-.154 2.64-.616 3.881h12.95v20.183c0 .931-.617 1.552-1.542 1.552H7.625c-.925 0-1.542-.62-1.542-1.552v-12.11C5.004 22.922 3.925 22.146 3 21.37v13.972C3 37.982 5.004 40 7.625 40h27.75C37.995 40 40 37.982 40 35.342V10.658C40 8.018 37.996 6 35.375 6z" id="Path"/><path id="Rectangle" d="M17 25h3v3h-3zM29 19h3v3h-3zM29 31h3v3h-3zM29 25h3v3h-3z"/></g></g></svg>
        <div>
            <div class="text-sm font-medium text-white">You are on Trial Period for the basic plan</div>
            <div class="text-xs text-gray-200">You have {{ auth()->user()->trial_ends_at->diffInDays(now()) }} days left on your trial.</div>
        </div>
        @if(isset($action_btn) && $action_btn)
            <a href="{{ route('billing') }}" class="text-white px-4 py-2 rounded border border-gray-300 self-end ml-auto">Upgrade Account</a>
        @endif
    </div>
</div>
