<x-app-layout>
    <x-slot name="header">
        <x-header
            headerTitle="売上入力"
            buttonTitle="売上一覧"
            :route="route('sale.index')"
        ></x-header>
    </x-slot>

    <x-session-message></x-session-message>
    <div class="flex justify-center w-screen">
        <form method="POST" action="{{route('sale.store')}}" class="w-full">
            @csrf
            <div class="grid gap-6 mb-8 py-6 px-4 md:grid-cols-4">
                <div class="min-w-0 md:col-span-1">
                    <div class="shadow-md px-5 py-3 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="relative flex flex-row justify-between items-center m-3">
                            <span class="absolute -top-4 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">日付</span>
                            <input id="date" name="date" type="date" value="{{ old('date') }}" required
                                   class="w-full focus:border-blue-500 w-auto rounded-md sm:text-sm border-gray-300 text-right">
                        </div>
                        @if(Auth::user()->is_admin === 1)
                            <div class="relative flex flex-row justify-between items-center m-3">
                                <span class="absolute -top-4 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">店舗</span>
                                <select name="shop_id" required
                                        class="w-full focus:ring-blue-500 focus:border-blue-500 w-auto rounded-md sm:text-sm border-gray-300">
                                    @foreach($shops as $shop)
                                        <option
                                            value="{{ $shop->id }}" {{ old('shop_id') == $shop->id ? 'selected' : '' }}>{{ $shop->shop_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input id="shop_id" name="shop_id" type="hidden" value="{{ Auth::user()->shop_id }}">
                        @endif
                    </div>
                </div>

                <div class="min-w-0 md:col-span-3">
                    <div class="shadow-md p-5 bg-white rounded-lg shadow-xs dark:bg-gray-800 mb-24">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="p-5 font-bold text-sm uppercase text-gray-500 border-gray-300 hidden lg:table-cell">
                                    商品 (SKU)
                                </th>
                                <th class="p-5 font-bold text-sm uppercase text-gray-500 border-gray-300 hidden lg:table-cell">
                                    単価
                                </th>
                                <th class="p-5 font-bold text-sm uppercase text-gray-500 border-gray-300 hidden lg:table-cell">
                                    点数
                                </th>
                                <th class="p-5 font-bold text-sm uppercase text-gray-500 border-gray-300 hidden lg:table-cell">
                                    金額
                                </th>
                                <th class="p-5 font-bold text-sm uppercase text-gray-500 border-gray-300 hidden lg:table-cell"></th>
                            </tr>
                            </thead>
                            <tbody id="detailTable">
                            @if(old('sku'))
                                @for($i = 0; $i < count(old('sku')); $i++)
                                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">SKU</span>
                                            <div>
                                                <label for="sku"
                                                       class="block text-sm font-medium text-gray-700"></label>
                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                    <select id="sku" name="sku[]" required
                                                            class="sku focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                        <option value="">-</option>
                                                        @foreach($items as $item)
                                                            <option
                                                                value="{{ $item->sku }}" {{ old('sku')[$i] == $item->sku ? 'selected' : '' }}>{{ $item->display_name . ' (' . $item->sku . ')' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
                                        <span
                                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">単価</span>
                                            <div>
                                                <label for="price"
                                                       class="block text-sm font-medium text-gray-700"></label>
                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                    <input id="price" name="price[]" type="number" readonly
                                                           value="{{ old('price')[$i] }}"
                                                           class="price flex-1 block w-full rounded-md bg-gray-200 sm:text-sm border-gray-300">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
                                            <span
                                                class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">quantity</span>
                                            <div>
                                                <label for="quantity"
                                                       class="block text-sm font-medium text-gray-700"></label>
                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                    <input id="quantity" name="quantity[]" type="number" required
                                                           value="{{ old('quantity')[$i] }}"
                                                           class="quantity focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
                                            <span
                                                class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">amount</span>
                                            <div>
                                                <label for="amount"
                                                       class="block text-sm font-medium text-gray-700"></label>
                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                    <input id="amount" name="amount[]" type="number" required
                                                           value="{{ old('amount')[$i] }}"
                                                           class="amount focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                </div>
                                            </div>
                                        </td>
{{--                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">--}}
{{--                                            <div>--}}
{{--                                                <div style="display: none"--}}
{{--                                                     class="del-row bg-white text-gray-800 font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md py-1 px-6 inline-flex items-center">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"--}}
{{--                                                         viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                                        <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                              stroke-width="2" d="M6 18L18 6M6 6l12 12"/>--}}
{{--                                                    </svg>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
                                    </tr>
                                @endfor
                            @else
                                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
                                        <span
                                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">SKU</span>
                                        <div>
                                            <label for="sku" class="block text-sm font-medium text-gray-700"></label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <select id="sku" name="sku[]" required
                                                        class="sku focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                    <option value="">-</option>
                                                    @foreach($items as $item)
                                                        <option
                                                            value="{{ $item->sku }}">{{ $item->display_name . ' (' . $item->sku . ')' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
                                        <span
                                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">単価</span>
                                        <div>
                                            <label for="price"
                                                   class="block text-sm font-medium text-gray-700"></label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input id="price" name="price[]" type="number" readonly
                                                       class="price flex-1 block w-full rounded-md bg-gray-200 sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
                                        <span
                                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">quantity</span>
                                        <div>
                                            <label for="quantity"
                                                   class="block text-sm font-medium text-gray-700"></label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input id="quantity" name="quantity[]" type="number" min="1" required
                                                       class="quantity focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">amount</span>
                                        <div>
                                            <label for="amount" class="block text-sm font-medium text-gray-700"></label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input id="amount" name="amount[]" type="number" readonly
                                                       class="amount flex-1 block w-full rounded-md bg-gray-200 sm:text-sm border-gray-300">
                                            </div>
                                        </div>
                                    </td>
{{--                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">--}}
{{--                                        <div>--}}
{{--                                            <div style="display: none"--}}
{{--                                                 class="del-row bg-white text-gray-800 font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md py-1 px-6 inline-flex items-center">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"--}}
{{--                                                     viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                          stroke-width="2" d="M6 18L18 6M6 6l12 12"/>--}}
{{--                                                </svg>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="w-full lg:w-auto p-3 text-gray-800 text-center block relative">
                            <div id="add-row"
                                 class="bg-white text-gray-800 font-bold rounded border-b-2 border-blue-500 hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-1 px-6 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                入力欄を追加
                            </div>
                        </div>
{{--                        <div class="p-3 bg-gray-50 text-right">--}}

{{--                            <button type="submit"--}}
{{--                                    class="bg-white text-gray-800 font-bold rounded border-b-2 border-blue-500 hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-1 px-6 inline-flex items-center">--}}
{{--                                作成--}}
{{--                            </button>--}}
{{--                        </div>--}}
                    </div>
                    <div class="min-w-0 md:col-span-1 mt-5">
                        <div class="shadow-md p-5 mb-10 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div class="relative flex flex-row justify-between items-center mx-3 my-5">
                                <span class="absolute -top-4 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">日付</span>
{{--                                <input id="date" name="date" type="date" value="2022-01-05" readonly--}}
{{--                                       class="w-full bg-gray-200 w-auto rounded-md sm:text-sm border-gray-300 text-right">--}}
                                <input id="date" type="text" value="2022/01/05" readonly
                                       class="w-full bg-gray-200 w-auto rounded-md sm:text-sm border-gray-300 text-right">
                            </div>
                            @if(Auth::user()->is_admin === 1)
                                <div class="relative flex flex-row justify-between items-center mx-3 my-5">
                                    <span class="absolute -top-4 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">店舗</span>
                                    <select name="shop_id" required
                                            class="w-full focus:ring-blue-500 focus:border-blue-500 w-auto rounded-md sm:text-sm border-gray-300">
                                        @foreach($shops as $shop)
                                            <option
                                                value="{{ $shop->id }}" {{ old('shop_id') == $shop->id ? 'selected' : '' }}>{{ $shop->shop_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input id="shop_id" name="shop_id" type="hidden" value="{{ Auth::user()->shop_id }}">
                            @endif
{{--                            <div class="relative flex flex-row justify-between items-center mx-3 mt-8 mb-5">--}}
{{--                                <span class="absolute -top-4 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">点数小計</span>--}}
{{--                                <input id="total-quantity" type="number" readonly--}}
{{--                                       class="w-full bg-gray-200 w-auto rounded-md sm:text-sm border-gray-300 text-right">--}}
{{--                            </div>--}}
{{--                            <div class="relative flex flex-row justify-between items-center mx-3 mt-8 mb-4">--}}
{{--                                <span class="absolute -top-4 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">金額小計</span>--}}
{{--                                <input id="total-amount" type="number" readonly--}}
{{--                                       class="w-full bg-gray-200 w-auto rounded-md sm:text-sm border-gray-300 text-right">--}}
{{--                            </div>--}}
                        </div>
{{--                        <footer class="bg-green-700 text-3xl text-white text-center fixed inset-x-0 bottom-0 p-4">--}}
                        <footer class="bg-white shadow-md font-bold py-2 px-4 border-t-2 border-blue-800 hover:border-blue inset-x-0 bottom-0 p-3 fixed">
                            <div class="relative flex flex-row justify-between items-center mx-4 mt-5">
                                <span class="absolute -top-3 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">日付</span>
                                {{--                                <input id="date" name="date" type="date" value="2022-01-05" readonly--}}
                                {{--                                       class="w-full bg-gray-200 w-auto rounded-md sm:text-sm border-gray-300 text-right">--}}
                                <input id="date" type="text" value="2022/01/05" readonly
                                       class="w-full bg-gray-200 w-auto rounded-md sm:text-sm border-gray-300 text-right">
                            </div>
                            @if(Auth::user()->is_admin === 1)
                                <div class="relative flex flex-row justify-between items-center mx-4 mt-5">
                                    <span class="absolute -top-3 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">店舗</span>
                                    <select name="shop_id" required
                                            class="w-full focus:ring-blue-500 focus:border-blue-500 w-auto rounded-md sm:text-sm border-gray-300">
                                        @foreach($shops as $shop)
                                            <option
                                                value="{{ $shop->id }}" {{ old('shop_id') == $shop->id ? 'selected' : '' }}>{{ $shop->shop_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input id="shop_id" name="shop_id" type="hidden" value="{{ Auth::user()->shop_id }}">
                            @endif
                            <div class="relative flex flex-row justify-between items-center mx-4 mt-5">
                                <span class="absolute -top-3 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">点数小計</span>
                                <input id="total-quantity" type="number" readonly
                                       class="w-full bg-gray-200 w-auto rounded-md sm:text-sm border-gray-300 text-right">
                            </div>
                            <div class="relative flex flex-row justify-between items-center mx-4 mt-5">
                                <span class="absolute -top-3 -left-4 lg:hidden bg-blue-200 px-2 py-1 text-xs font-bold uppercase">金額小計</span>
                                <input id="total-amount" type="number" readonly
                                       class="w-full bg-gray-200 w-auto rounded-md sm:text-sm border-gray-300 text-right">
                            </div>
                            <div class="flex w-full">
                                <button type="submit"
                                        class="bg-gradient-to-r from-blue-400 to-blue-700
                                       hover:from-blue-700 hover:to-blue-800
                                       focus:from-blue-700 focus:to-blue-800
                                       rounded-full w-full font-bold text-xl text-white m-3 py-2">
                                    売上を新しく作成する</button>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script type='text/javascript'>
            $(document).ready(function () {
                toggleDeleteButton();
                reevaluateQuantity();
                reevaluateAmount();

                $('#add-row').on('click', function () {
                    let html = `<tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">SKU</span>
                                    <div>
                                        <label for="sku" class="block text-sm font-medium text-gray-700"></label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <select id="sku" name="sku[]" required
                                                    class="sku focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                                <option value="">-</option>
                                                @foreach($items as $item)
                    <option value="{{ $item->sku }}">{{ $item->display_name . ' (' . $item->sku . ')' }}</option>
                                                @endforeach
                    </select>
                </div>
            </div>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">単価</span>
            <div>
                <label for="price"
                       class="block text-sm font-medium text-gray-700"></label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input id="price" name="price[]" type="number" readonly
                           class="price flex-1 block w-full rounded-md bg-gray-200 sm:text-sm border-gray-300">
                </div>
            </div>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">quantity</span>
            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700"></label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input id="quantity" name="quantity[]" type="number" min="1" required class="quantity focus:ring-blue-500 focus:border-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                </div>
            </div>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
            <span
                class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">amount</span>
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700"></label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input id="amount" name="amount[]" type="number" readonly
                           class="amount flex-1 block w-full rounded-md bg-gray-200 sm:text-sm border-gray-300">
                </div>
            </div>
        </td>
        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border-b block lg:table-cell relative lg:static text-sm">
            <div>
                <div class="del-row bg-white text-gray-800 font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md py-1 px-6 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </td>
        </tr>`;
                    $('#detailTable').append(html);
                    toggleDeleteButton();
                });

                $('#detailTable').on('click', '.del-row', function () {
                    const parent = $(this).closest('tr');
                    parent.remove();
                    toggleDeleteButton();
                    reevaluateQuantity();
                    reevaluateAmount();
                });

                $('#detailTable').on('input', '.quantity', function () {
                    reevaluateQuantity();
                    sumItemPrice();
                });

                $('#detailTable').on('change', '.sku', function () {
                    inputItemPrice(getItemPriceAll());
                    sumItemPrice();
                });
            });

            function toggleDeleteButton() {
                if ($('#detailTable tr').length > 1) {
                    $('.del-row').show();
                } else {
                    $('.del-row').hide();
                }
            }

            function reevaluateQuantity() {
                let total = 0;
                $('.quantity').each(function () {
                    if ($(this).val()) {
                        total += parseInt($(this).val(), 10);
                    }
                });

                $('#total-quantity').val(total);
            }

            function reevaluateAmount() {
                let total = 0;
                $('.amount').each(function () {
                    if ($(this).val()) {
                        total += parseInt($(this).val(), 10);
                    }
                });
                $('#total-amount').val(total);
            }

            function getItemPriceAll() {
                const items = @json($items);
                let itemPriceAll = [];

                $('.sku').each(function () {
                    items.forEach(item => {
                        if ($(this).val() === item.sku) {
                            itemPriceAll.push(item.price);
                        }
                    });
                });
                return itemPriceAll;
            }

            function inputItemPrice(itemPriceAll) {
                let i = 0;
                $('.price').each(function () {
                    if($('.price').val() != "") {
                        $(this).val(itemPriceAll[i++]);                        
                    }
                });
            }

            function sumItemPrice () {
                let prices = [];
                $('.price').each(function () {
                    prices.push($(this).val());
                });

                let quantities = [];
                $('.quantity').each(function () {
                    quantities.push($(this).val());
                });

                let itemAmountList = [];
                let subtotal = 0;
                for (let i = 0; i < prices.length; i++) {
                    itemAmountList.push(prices[i] * quantities[i]);
                    subtotal = subtotal + (prices[i] * quantities[i]);
                }

                i = 0;
                $('.amount').each(function () {
                    $(this).val(itemAmountList[i++]);
                });

                $('#total-amount').val(subtotal);
            }
        </script>
    @endpush
</x-app-layout>
