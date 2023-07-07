<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5 class="text-uppercase">LAPORAN REKAPAN DATA KANDIDAT {{$type}}</h4>
            <h6>{{ $start }} - {{ $end }}</h6>
		{{-- <h6><a target="_blank" href="https://www.mal1asngoding.com/membuat-laporan-…n-dompdf-laravel/">www.malasngoding.com</a></h5> --}}
	</center>
 
	<table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>GPA</th>
                <th>Semester</th>
                <th>Pengalaman Kerja</th>
                <th>Institusi/Universitas</th>
                {{-- <th>CV</th> --}}
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($pelamarans as $item)
               <tr>
                    <th>{{$item->user->name}}</th>
                    <td>
                        <div class="text-uppercase">{{ $item->isFreshGraduate == 1 ? "Fresh Graduate" : $item->gpa . " - " .$item->status_gpa}}</div>
                    </td>
                    <td>
                        <div class="text-uppercase">{{ $item->isFreshGraduate == 1 ? "Fresh Graduate" : $item->semester . " - " .$item->status_semester}}</div>
                    </td>
                    <td>
                        <div class="text-uppercase">{{ $item->isFreshGraduate == 1 ? "Fresh Graduate" : $item->pengalaman_kerja . " - " .$item->status_pengalaman_kerja}}</div>
                    </td>
                    <td>
                        {{$item->institution}}
                    </td>
                </tr> 
            @endforeach
        </tbody>
    </table>
 
</body>
</html>