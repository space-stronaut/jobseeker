<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halo Penerima</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="font-family: Arial, sans-serif;">

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron" style="background-color: #f8f8f8; padding: 20px; text-align: center;">
                    <h1 class="display-4">{{ $title }}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card" style="background-color: #ffffff; padding: 20px;">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Nama Pelamar</th>
                                <th>:</th>
                                <td>
                                    {{ $pelamaran->user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>Status lamaran</th>
                                <th>:</th>
                                <td class="text-uppercase">
                                    {{ $pelamaran->status }}
                                </td>
                            </tr>
                            
                        </table>
                        <center>
                            <a href="{{ route('job.show', $job->id) }}" class="btn btn-primary">Cek Disini</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
