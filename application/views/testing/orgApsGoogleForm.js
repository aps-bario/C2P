/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function processForm(GF){
    var GF1 = GF[1]; // Blank
    var GF2 = GF[2]; // GoogleForm Data
    var GFH = GF2[1]; // Header - Title
    var GFB = GF2[2]; // Body - Logical Question Squence
    var GFF = GF2[3]; // Footer - Final Statement e.g. Thank you.
    // *** GFB Questions Format *** [QuID,QuestionText,DefaultAnswer,QuestionType,[GFA]]
    // *** GFA Answers Format *** [AnID,GFO,1] ??? Last Value
    // *** GFO Options Format *** e.g. [[Opt1],[Opt2],[Opt3],[Opt4],[Opt5],[,,,,1]] ??? Last Option?
    var data = GF2;
    $("document").ready(function(e){
        var GF1 = GF[0]; // Blank
        var GF2 = GF[1]; // GoogleForm Data
        var GFH = GF2[0]; // Header - Title
        var GFB = GF2[1]; // Body - Logical Question Squence
        var GFQ, GFA, GFO, GFX, GFY; // A Question
        var GFF = GF2[2]; // Footer - Final Statement e.g. Thank you.
        var row;
        //alert(GFH)
        // *** GFB Questions Format *** [QuID,QuestionText,DefaultAnswer,QuestionType,[GFA]]
        // *** GFA Answers Format *** [AnID,GFO,Required] 
        // *** GFO Options Format *** e.g. [[Opt1],[Opt2],[Opt3],[Opt4],[Opt5],[,,,,1]] ??? Last Option?
        row = "";
        //row=row+"<Fieldset style='bgcolor:lightgray;'><Legend>Google Form</legend>";
        row=row+"<H1 class='Start'>"+GFH+"</h1>";
        row=row+"<Form id='GF'>";
        row=row+"<div id='Questions'>";
        row=row+"</div>";
        row=row+"</form>";
        row=row+"<H3 class='Finish' style='visible:false;'>"+GFF[0]+"</h3>";
        //row=row+"</fieldset>";
        $("#FormBody").append(row);
        row="<div><fieldset><b style='color:red;'>[* Required]</b>";
        ThisSectionID = 0; //GFB[0][0];
        LastSectionID = 0;
        for(q=0;q<GFB.length;q++){  
            GFQ = GFB[q];
            //row="";
            if(GFQ[3]===8){// Header
                //row=row+"<input type='hidden' id='n"+ThisSectionID+"' value='TESTING'>";
                if(LastSectionID>0){
                    row=row+"<input class='btnPrev' type='button' onclick='prev("
                        +ThisSectionID+","+LastSectionID+");' value='PREV' />";
                }
                if(ThisSectionID>0){
                    row=row+"<input class='btnNext' type='button' onclick='next("
                        +ThisSectionID+","+GFQ[0]+");' value='NEXT' />";
                }
                row=row+"</fieldset>";
                row=row+"</div>";
                $("#Questions").append(row);
                row = "<div class='Section' id='q"+GFQ[0]+"' onfocus='//setNextID("+GFQ[0]+");'>";
                row=row+"<fieldset><legend><B>"+GFQ[1]+"</B>"
                //row=row+"&nbsp;<sup>["+GFQ[0]+"]</sup>"
                row=row+"</legend>";
                LastSectionID = ThisSectionID;
                ThisSectionID = GFQ[0];
                //row=row+"<h4>"+GFQ[1]+"</h4>";
                
            } else if(GFQ[3]===0){
                GFA = GFQ[4][0]; // Not clear why array is encapsulated
                row=row+"<div class='Question' id='q"+GFQ[0]+"'>";
                row=row+GFQ[1]+(GFA[2]===1?"&nbsp;<sup><b style='color:red;'>*</b></sup>":"");
                //row=row+"&nbsp;<sup>["+GFQ[0]+"]&nbsp;[Type:"+GFQ[3]+"]</sup>";
                row=row+"<br/><input name="+GFQ[0]+"'id='a"+GFQ[0]+"' type='text' width=150 ";
                row=row+(GFA[2]===1?" required":"");
                row=row+">"+GFQ[2]+"</input>";
                //row=row+"<sup>["+GFA[0]+"]</sup><br/>";
                row=row + "</div>";
            } else if(GFQ[3]===1){ // TextArea
                GFA = GFQ[4][0]; // Not clear why array is encapsulated
                row=row+"<div class='Question' id='q"+GFQ[0]+"'>";
                row=row+GFQ[1]+(GFA[2]===1?"&nbsp;<sup><b style='color:red;'>*</b></sup>":"");
                //row=row+"&nbsp;<sup>["+GFQ[0]+"]&nbsp;[Type:"+GFQ[3]+"]</sup>";
                row=row+"<br/><textarea name="+GFQ[0]+"'id='a"+GFQ[0]+"' rows=4 width=300>"+GFQ[2]+"</textarea>";
                //row=row+"<sup>["+GFA[0]+"]</sup><br/>";
                row=row+"</div>";
            } else if(GFQ[3]===2){ // Radio
                GFX = GFQ[4];
                GFA = GFX[0]; // Not clear why array is encapsulated
                row=row+"<div class='Question' id='q"+GFQ[0]+"'>";
                row=row+GFQ[1]+(GFA[2]===1?"&nbsp;<sup><b style='color:red;'>*</b></sup>":"");
                //row=row+"&nbsp;<sup>["+GFQ[0]+"]&nbsp;[Type:"+GFQ[3]+"]</sup>";
                GFO = GFA[1];
                for(a=0;a<GFO.length;a++){
                    row=row+"<br/><input name='"+GFQ[0]+"' id='a"+GFA[0]+"' ";
                    row=row+"onchange='setNextID("+GFO[a][2]+");' ";
                    row=row+"type='radio' value='"+GFO[a][0]+"'";
                    row=row+(GFA[2]===1?" required":"");
                    row=row+">"+GFO[a][0]+"</input>";
                }
                //row=row+"<sup>["+GFA[0]+"]</sup><br/>";
                row=row + "</div>";
            } else if(GFQ[3]===3){ // Radio
                GFA = GFQ[4][0]; // Not clear why array is encapsulated
                row=row+"<div class='Question' id='q"+GFQ[0]+"'>";
                row=row+GFQ[1]+(GFA[2]===1?"&nbsp;<sup><b style='color:red;'>*</b></sup>":"");
                //row=row+"&nbsp;<sup>["+GFQ[0]+"]&nbsp;[Type:"+GFQ[3]+"]</sup>";
                GFO = GFA[1];
                for(a=0;a<GFO.length;a++){
                    row=row+"<br/><input name="+GFQ[0]+"' id='a"+GFA[0]+"' type='radio' "
                    row=row+"value='"+GFO[a][0]+"'"
                    row=row+"onchange='setNextID("+GFO[a][2]+");' ";
                    row=row+(GFA[2]===1?" required":"");
                    row=row+">"+GFO[a][0]+"</input>";
                    //$("#a"+GFA[0]).change(function(){
                    //    alert("#q"+GFO[a][2]);
                    //    $("q"+GFO[a][2]).focus();
                    //});
                 }
                //row=row+"<sup>["+GFA[0]+"]</sup><br/>";
                row=row + "</div>";
            } else if(GFQ[3]===4){ // Checkbox
                GFA = GFQ[4][0]; // Not clear why array is encapsulated
                row=row+"<div class='Question' id='q"+GFQ[0]+"'>";
                row=row+GFQ[1]+(GFA[2]===1?"&nbsp;<sup><b style='color:red;'>*</b></sup>":"");
                //row=row+"&nbsp;<sup>["+GFQ[0]+"]&nbsp;[Type:"+GFQ[3]+"]</sup>";
                GFO = GFA[1];
                for(a=0;a<GFO.length;a++){
                    row=row+"<br/><input name="+GFQ[0]+"' id='a"+GFA[0]+"' type='checkbox' "
                    row=row+"value='"+GFO[a][0]+"'"
                    row=row+"onchange='setNextID("+GFO[a][2]+");' ";
                    row=row+(GFA[2]===1?" required":"");
                    row=row+">"+GFO[a][0]+"</input>";
                    //$("#a"+GFA[0]).change(function(){
                    //    alert("#q"+GFO[a][2]);
                    //    $("q"+GFO[a][2]).focus();
                    //});
                }
                //row=row+"<sup>["+GFA[0]+"]</sup><br/>";
                row=row + "</div>";
            } else if(GFQ[3]===5){ // Scale ?
               GFA = GFQ[4][0]; // Not clear why array is encapsulated
                row=row+"<div class='Question' id='q"+GFQ[0]+"'>";
                row=row+GFQ[1]+(GFA[2]===1?"&nbsp;<sup><b style='color:red;'>*</b></sup>":"");
                //row=row+"&nbsp;<sup>["+GFQ[0]+"]&nbsp;[Type:"+GFQ[3]+"]</sup>";
                row=row+"<br>";
                GFO = GFA[1];
                for(a=0;a<GFO.length;a++){
                    row=row+"<input name="+GFQ[0]+"' id='a"+GFA[0]+"' type='radio' ";
                    row=row+"value='"+GFO[a][0]+"'";
                    row=row+(GFA[2]===1?" required":"");
                    row=row+">"+GFO[a][0]+"</input>";
                    $("#a"+GFA[0]).change(function(){
                        //alert("#q"+GFO[a][2]);
                        $("q"+GFO[a][2]).focus();
                    });
                }
                //row=row+"<sup>["+GFA[0]+"]</sup><br/>";
                row=row + "</div>";
            } else {   
                row=row+"<div class='Question' id='q"+GFQ[0]+"'>";
                row=row+GFQ[1]+(GFA[2]===1?"&nbsp;<sup><b style='color:red;'>*</b></sup>":"");
                //row=row+"&nbsp;<sup>["+GFQ[0]+"]&nbsp;[Type:"+GFQ[3]+"]</sup>";
                row=row + "</div>";
            }
                //$("#Questions").append(row);
        }
        row=row+"</fieldset></div>";
        $("#Questions").append(row);
        $(".Section").hide();
        $(".Section:first").show();
    //    $(".Section").hide();
        $(".Finish").hide();
    });
    }
    function setNext(obj){
        $(".Next").removeClass('Next');
        obj.addClass('Next');
        //alert($(".Next").attr('id'));
    }
    function setNextID(id){
        $(".Next").removeClass("Next");
        $("#q"+id).addClass("Next");
    }
    function next(obj,nxt){ 
        // Check each input to ensure that required elements have a value
        var allDone = true;
        //alert($("#q"+obj+" input").length);
        $("#q"+obj+" input").each(function(){
            if($(this).prop('required')===true){
                //alert($(this).value);     
       //         && $(this).val() == "" ){
       //         alert($(this).prop('id'));  
       //     if ( $(this).value === "" && $(this).prop('required')) {
       //         allDone = false;
       //         alert("Please provide an answer!");
       //         this.focus();
            }
        });
        if(allDone){
            // Hide all the Sections and reveal just the one marked next
            $(".Section").hide();
            $("#q"+obj).hide();
            if(!$(".Next").length){
                // If no element marked Next then show the following 'nxt' section
                $("#q"+nxt).addClass("Next");
            }
            $(".Next").show();
            $(".Next").removeClass("Next");
        }
    }
    function prev(obj,prv){ 
        /*
        // Check each input to ensure that required elements have a value
        var allDone = true;
        $("#q"+obj+" input").each(function( i ) {
            if ( $(this).value === "" && $(this).prop('required')) {
                allDone = false;
                alert("Please provide an answer!");
                this.focus();
            }
        });
        if(allDone){
        */
            // Hide all the Sections and reveal just the one marked next
            $(".Section").hide();
            $("#q"+obj).hide();
            if(!$(".Prev").length){
                // If no element marked Next then show the following 'nxt' section
                $("#q"+prv).addClass("Prev");
            }
            $(".Prev").show();
            $(".Prev").removeClass("Prev");
        //}
    }
 /*   
    $( '#form_id' ).submit( function( event ) {
        event.preventDefault();

        //validate fields
        fail = false;
        fail_log = '';
        $( '#form_id' ).find( 'select, textarea, input' ).each(function(){
            if( ! $( this ).prop( 'required' )){

            } else {
                if ( ! $( this ).val() ) {
                    fail = true;
                    name = $( this ).attr( 'name' );
                    fail_log += name + " is required \n";
                }

            }
        });

        //submit if fail never got set to true
        if ( ! fail ) {
            //process form here.
        } else {
            alert( fail_log );
        }
*/

    
