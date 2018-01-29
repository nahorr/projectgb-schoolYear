<!DOCTYPE html>
<html lang="en">
<head>
  <title>Totalgrades - Print All Registration Code</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css" media="all">
    
    .page {
      overflow: hidden;
      page-break-before: always;
      page-break-inside: avoid;
      }
  </style>
</head>
<body>

@foreach($students as $student)
<div class="page">
  <div class="bg-danger text-white"><h2>Registration Information for {{@$student->first_name}} {{@$student->last_name}} </h2></div>
  <p>To be able to use the gradebook portable, you need to register.</p>
  <p>Follow the steps below to Register:</p>
  <ul>
    <li>Visit the gradebook portal login page http://gb20162017.eginny.com/login</li>
    <li>Click on 'Register' on the top right corner of the page</li>
    <li>Enter your:
    <ol>
     <li>Full Name,</li>
     <li>A valid email,</li>
     <li>The registration code provide on this page(below),</li>
     <li>Password - must be at least 6 characters(please use a strong password)
     </ol>
    </li>
    <li>Click on submit</li>
  </ul>           
  <table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="row">School:</th>
      <td>{{@$school->name}}</td>
    </tr>
    <tr>
      <th scope="row">School Year:</th>
      <td>{{@$school_year->school_year}}</td>
    </tr>
    <tr>
      <th scope="row">Class:</th>
      <td>{{@$class->name}}</td>
    </tr>
    <tr>
      <th scope="row">Firstname:</th>
      <td>{{@$student->first_name}}</td>
    </tr>
    <tr>
      <th scope="row">Lastname:</th>
      <td>{{@$student->last_name}}</td>
    </tr>
    <tr>
      <th scope="row">Registration Code:</th>
      <td>{{@$student->registration_code}}</td>
    </tr>
  </tbody>
</table>

<div class="bg-primary text-white"><h2>Bank Deposit/Transfer Information</h2></div>
    @foreach($terms as $term)
        @if($today->between($term->start_date, $term->show_until))
         <div class="bg-info text-white"><h2>TERM: {{@$term->term}}</h2></div>
        @endif
    @endforeach
  <p>Use the information below for Tuition Payment</p>
   <p>Please <mark>Qoute</mark> your registration, <mark>{{@$student->registration_code}}</mark>, on the tranfer. </p>         
  <table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="row">Bank Name:</th>
      <td>{{@$school->name}}</td>
    </tr>
    <tr>
      <th scope="row">Bank Account Name:</th>
      <td>Zenith Bank PLC</td>
    </tr>
    <tr>
      <th scope="row">Bank Account Number:</th>
      <td>0027658910017</td>
    </tr>
    <tr>
      <th scope="row">Amout Due Now:</th>
      <td>

      @foreach($terms as $term)

        @if($today->between($term->start_date, $term->show_until))

            @foreach(@$term_tuitions as $term_tuition)

                @if(@$term->id == @$term_tuition->term_id )

                    NGN {{@$term_tuition->amount}}

                @endif

            @endforeach
        @endif   
      @endforeach
      </td>
    </tr>
      
  </tbody>
</table>
</div>
@endforeach

</body>
</html>
