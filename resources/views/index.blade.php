<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<title>Document</title>
</head>
<body>
	@if ($errors->any())
		<div class="alert alert-danger">
				<ul>
						@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
						@endforeach
				</ul>
		</div>
	@endif
	<button type="button" class="focus:outline-none openModal text-white text-sm py-2.5 px-5 mt-5 mx-5  rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">CSVデータ取り込み</button>
	<div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="interestModal">
			<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
					<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
							<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
							<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
								<form method="POST" action="/users" enctype="multipart/form-data">
									<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
											{{ csrf_field() }}
											<input type="file" id="file" name="file" class="form-control">												
										</div>
										<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
											<button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
												インポート
											</button>
											<button type="button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
												キャンセル
											</button>
										</div>
								</form>
							</div>
					</div>
			</div>
	</div>
	<script>
			$(document).ready(function () {
					$('.openModal').on('click', function(e){
							$('#interestModal').removeClass('invisible');
					});
					$('.closeModal').on('click', function(e){
							$('#interestModal').addClass('invisible');
					});
			});
	</script>
	</body>
</html>