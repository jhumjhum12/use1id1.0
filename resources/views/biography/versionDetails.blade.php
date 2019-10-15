<?php
// echo '<pre>';print_r($versions);
// echo $summary;exit;
?>
<table class="table">
                  <thead>
                     <tr>
                        <th>{{ Label::get('version_des') }}</th>
                        <th>{{ Label::get('version_summery') }}</th>                        
                     </tr>
                  </thead>
                  <tbody>
					@if($versions)
					
				
                     <tr >                        
                        <td>{{$versions->introduction}}</td>
                        <td>{{$summary}} entries</td>                       
                     </tr>
					
					@else
					  <tr>
						<td colspan="3">No Results Found!</td>
					  </tr>	
					@endif		
                  </tbody>
               </table>