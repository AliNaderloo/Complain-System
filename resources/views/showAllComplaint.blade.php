
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link  rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.css')}}"></link>
	<script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
	<link  rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"></link>
	<link  rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"></link>
	<script  type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		$( document ).ready(function() {
			@if($errors->any())
			toastr.success('{{$errors->first()}}');
			@endif
			$('#DataTable').DataTable({
				"language": {
					"sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
					"sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
					"sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
					"sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
					"sInfoPostFix":    "",
					"sInfoThousands":  ",",
					"sLengthMenu":     "نمایش _MENU_ رکورد",
					"sLoadingRecords": "در حال بارگزاری...",
					"sProcessing":     "در حال پردازش...",
					"sSearch":         "جستجو:",
					"sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
					"oPaginate": {
						"sFirst":    "ابتدا",
						"sLast":     "انتها",
						"sNext":     "بعدی",
						"sPrevious": "قبلی"
					},
					"oAria": {
						"sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
						"sSortDescending": ": فعال سازی نمایش به صورت نزولی"
					}
				}
			});
		});
	</script>
	

</head>
<body style="margin: 40px; direction: rtl; text-align: right; ">
	<div class="container">
	<table id="DataTable" class="display hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					@foreach ($Table->head as $head)
					<th>{{$head}}</th>
					@endforeach
				</tr>
			</thead>
			<tfoot>
				<tr>
					@foreach ($Table->head as $head)
					<th>{{$head}}</th>
					@endforeach
				</tr>
			</tfoot>
			<tbody>

				@foreach ($Table->data as $complaints)
				<a href="/"> <tr>
					<th>{{$complaints->fld_Consignment}}</th>
					<th>{{$complaints->getComplaint->fld_Complaints_Subjects}}</th>
					<th>{{$complaints->fld_Description}}</th>
					<th>
						@if($complaints->fld_Level == 1)
						ثبت شده است
						@elseif($complaints->fld_Level == 2)
						در حال انجام
						@elseif($complaints->fld_Level == 3)
						به اتمام رسیده
						@endif
					</th>
				</tr> </a>
				@endforeach
			</tbody>
			
		</table>
	</div>
</body>
</html>