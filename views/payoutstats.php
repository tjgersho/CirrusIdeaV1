<?php

?>
<br />
<div class="content_underline"></div>

  <div class="container">
    <div class="row">
    <div class="col-sm-8">
    
     <div id="payoutstatschartcontainer" style="height: 400px">
 
    </div>
    
    </div>
    <div class="col-sm-4">
    
   <div class="payOutStats" style="margin-top:15px; margin-bottom:15px;">
                <table >
                    <tr>
                        <td>
                            Member
                          </td>
                        <td >
                            Percent Contribution 
                        </td>
                        <td>
                            Value Share 
                        </td>
                    </tr>
                    <tr ng-repeat="po in cirrusideaPageCtrl.payoutstats.tabledata.contribs">
                        <td >
                            {{po.member}}
                        </td>
                        <td>
                            {{po.percent | number: 2}} %

                        </td>
                        <td>
                              $ {{po.cashval | number : 2}}

                        </td>
                    </tr>
                     <tr>
                        <td colspan="2" style="text-align:right;">
                          
                          
                           Total:
                         </td>
                        <td>
                            ${{cirrusideaPageCtrl.payoutstats.tabledata.total}}
                        </td>
                    </tr>
                </table>
            </div>
               
    
    </div>
  
  
  </div>
 </div>

  <div class="clr"></div>

