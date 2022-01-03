<x-app-layout>
      <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('支出一覧') }}
        </h2>
        <button class="px-4 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80 visible sm:hidden">
            Primary
        </button>
    </x-slot>
    
    <div class="flex overflow-x-scroll w-full p-5 bg-slate-500">
        <table class="flex-none bg-white w-full whitespace-nowrap">
            <thead class="bg-gray-400 text-white">
                <tr>
                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">日付</th>
                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">支払方法</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">カテゴリ</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">金額</td>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">メモ</td>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($expenses as $expense)
                    <tr>
                        <td class="w-1/3 text-left py-3 px-4">{{ $expense->date }}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{ $expense->payment }}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{ $expense->category }}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{ $expense->amount }}</td>
                        <td class="w-1/3 text-left py-3 px-4"></td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>