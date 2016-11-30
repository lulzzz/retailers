@extends('app.layout.iframe')
@section('content')
   <div class="container-fluid">
      <div class="row">
         <div class="col-xs-12  p-2 small bg-gray">
            <h5>Retailers Datasheet</h5>
            <p>Each CSV file imported must contain the following columns and required datafields must be filled out. Upon import a unqiue ID will generated for each retailer wich will be used at a reference in your locations <b>.CSV</b> file.</p>
            <p><a href="/import">< Back to Import</a></p>
         </div>
         <div class="col-xs-12 p-0">
            <small>
               <table class="table tablesorter" id="table-list">
                  <thead >
                     <tr>
                        <th class="px-2">Column Header</th>
                        <th class="px-2">Value Type</th>
                        <th class="px-2">Example</th>
                        <th>Required</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="px-2">name</td>
                        <td class="px-2"><i>string</i></td>
                        <td class="px-2">Example Store</td>
                        <td>Yes</td>
                     </tr>
                     <tr>
                        <td class="px-2">description</td>
                        <td class="px-2"><i>text</i></td>
                        <td class="px-2">A cool store from Sweden.</td>
                        <td>No</td>
                     </tr>
                     <tr>
                        <td class="px-2">phone</td>
                        <td class="px-2"><i>numeric</i></td>
                        <td class="px-2"><i>-</i></td>
                        <td>No</td>
                     </tr>
                     <tr>
                        <td class="px-2">website</td>
                        <td class="px-2"><i>url</i></td>
                        <td class="px-2">www.domain.com</td>
                        <td>No</td>
                     </tr>
                     <tr>
                        <td class="px-2">email</td>
                        <td class="px-2"><i>string</i></td>
                        <td class="px-2">hello@email.com</td>
                        <td>No</td>
                     </tr>
                     <tr>
                        <td class="px-2">instagram</td>
                        <td class="px-2"><i>string</i></td>
                        <td class="px-2"><code>@handle</code></td>
                        <td>No</td>
                     </tr>
                     <tr>
                        <td class="px-2">facebook</td>
                        <td class="px-2"><i>string</i></td>
                        <td class="px-2"><code>facebook.com/retailer-name</code></td>
                        <td>No</td>
                     </tr>
                     <tr>
                        <td class="px-2">twitter</td>
                        <td class="px-2"><i>string</i></td>
                        <td class="px-2"><code>@handle</code></td>
                        <td>No</td>
                     </tr>
                     <tr>
                        <td>featured</td>
                        <td><i>yes/no</i></td>
                        <td><code>no</code></td>
                        <td>Yes</td>
                     </tr>
                     <tr>
                        <td>visibility</td>
                        <td><i>public/hidden</i></td>
                        <td>Public</td>
                        <td>Yes</td>
                     </tr>

                  </tbody>
               </table>
            </small>
         </div>
      </div>
   </div>
@stop
@section('js')
   <script>
   $('button[data-instructions]').click(function () {
      $('.instructions .instructions-inner').toggleClass('.drops');

      $(this).toggleClass('clientsClose');
   }); // end click
   </script>
@stop
