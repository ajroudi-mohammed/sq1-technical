<tr class="border-b border-gray-200 hover:bg-gray-100">
    <td class="py-3 px-6 text-left">
        <span class="font-medium">{{$title}}</span>
    </td>
    <td class="py-3 px-6 text-left">
        {{Str::words($description, 10);}}
    </td>
    <td class="py-3 px-6 text-center">
        {{$publishdate}}
    </td>
    <td class="py-3 px-6 text-center">
        <div class="flex item-center justify-center">
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 hover:cursor-pointer">
                <a href="{{route('posts.show', $id)}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </a>
            </div>
        </div>
    </td>
</tr>
