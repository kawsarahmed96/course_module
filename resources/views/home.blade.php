<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f4f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            margin-top: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
        }

        .module-card {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-left: 4px solid #0d6efd;
            border-radius: 8px;
            background-color: #ffffff;
        }

        .module-card h5 {
            margin-bottom: 15px;
            color: #0d6efd;
        }

        .content-group {
            margin-top: 15px;
            padding: 15px;
            border-left: 3px solid #198754;
            background-color: #f8f9fa;
            border-radius: 6px;
        }

        .btn-outline-primary.btn-sm {
            padding: 6px 10px;
            font-size: 14px;
        }

        input.form-control {
            border-radius: 6px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="card col-md-8 mx-auto">
            <div class="card-header bg-white border-bottom-0">
                <h4 class="mb-0">Create Course</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
            <div class="card-body">
                <form action="{{ route('form.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Course Name:</label>
                        <input type="text" class="form-control" name="course_name" placeholder="Course Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course Details:</label>
                        <textarea type="text" class="form-control" name="course_details" id="" cols="30" rows="3"></textarea>
                    </div>

                    <div id="modules"></div>

                    <button type="button" class="btn btn-primary mb-3 mt-1" id="add_module">+ Add Module</button>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Submit Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        let moduleIndex = 0;

        $('#add_module').on('click', function(e) {
            e.preventDefault();
            moduleIndex++;

            const moduleHTML = `
        <div class="module-card" data-module-index="${moduleIndex}">
            <h5>Module ${moduleIndex}</h5>
            <div class="mb-2">
                <input type="text" class="form-control" name="modules[${moduleIndex}][name]" placeholder="Module Name">
            

            </div>
            <div class="mb-2">
                <input type="text" class="form-control" name="modules[${moduleIndex}][description]" placeholder="Module Description">
            </div>
            <div class="mb-2">
                <input type="number" class="form-control" name="modules[${moduleIndex}][duration]" placeholder="Module Duration">
                

            </div>
            <div class="content-wrapper"></div>
            <button type="button" class="btn btn-outline-primary btn-sm add-content mt-2">+ Add Content</button>
        </div>
        `;

            $('#modules').append(moduleHTML);
        });

        $(document).on('click', '.add-content', function(e) {
            e.preventDefault();

            const moduleCard = $(this).closest('.module-card');
            const moduleIndex = moduleCard.data('module-index');
            let contentIndex = moduleCard.find('.content-group').length + 1;

            const contentHTML = `
        <div class="content-group">
            <input type="text" class="form-control mb-2" name="modules[${moduleIndex}][contents][${contentIndex}][name]" placeholder="Content Name">
            

            <input type="text" class="form-control" name="modules[${moduleIndex}][contents][${contentIndex}][description]" placeholder="Content Description">
        </div>
        `;

            moduleCard.find('.content-wrapper').append(contentHTML);
        });

    </script>
</body>
</html>
