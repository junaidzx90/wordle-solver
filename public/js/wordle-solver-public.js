const dataSource = wordleajax.data;

jQuery(document).ready(function($){
  
  function getCorrectLetterFilter(data){
    let pattern = '';
    $('.wordle_filter_bar.correct').find('.search_bar').each(function(i){
      if($(this).val() !== '') {
        pattern += $(this).val().toLowerCase();
      }else {
        pattern += '\\w+';
      }
    });
    
    let regexp = new RegExp(pattern, 'gi');
    let correctFilteredData = [...new Set(data.join(' ').match(regexp))];
    
    return correctFilteredData;
  }
  
  function getMisplacedLetterFilter(data){
    let missplacedObj = [];
    $('.wordle_filter_bar.misplaced').find('.search_bar').each(function(i){
        let v = $(this).val().toLowerCase();
        if(v !== ""){
          missplacedObj.push({
            index: i,
            char: v
          });
        }
    });
    
    let extrahars = [];
    let misplacedFilteredData = data.filter(el => {
        let x = missplacedObj.map(inp => {
        if(el.indexOf(inp.char) !== -1 && el.indexOf(inp.char) !== inp.index && el.indexOf(inp.char) !== el.lastIndexOf(inp.char)){
          extrahars.push(el)
        }
        
        return el.indexOf(inp.char) !== -1 && el.indexOf(inp.char) !== inp.index;
      });
      return x.every(element => element === true);
    });
    
    if(missplacedObj.length === 1){
      extrahars.map(r => {
        misplacedFilteredData.splice(misplacedFilteredData.indexOf(r), 1);
      });
    }
    
    return misplacedFilteredData;
  }
  
  function getIncorrect(data){
    let predefined = $(".prefix_data").text().toLowerCase();
    let strings = $('.wordle_filter_bar.incorrect').find('.search_bar').val().toLowerCase();
    strings += predefined;
    
    strings = strings.split('');
    let incorrectData = data.filter(el => {
      let x = strings.map(ch => {
        return el.indexOf(ch) === -1;
      });
      
      return x.every(element => element === true);
    });
    
    return incorrectData;
  }
  
  function commonRecommended(data){
    let letters = [...data.join('')].reduce((cnt, cur) => (cnt[cur] = cnt[cur] + 1 || 1, cnt), {});
    
    let commons = Object.keys(letters).map(el => {
        return {ch: el, count: letters[el]} 
    });
    
    let storege = [];
    data.filter(el => {
      let elm = el.split("");
      let power = 0;
      
      commons.filter(i => {
        let p = 0;
        for(let x = 0; x < elm.length; x++){
          if(elm[x] === i.ch){
            p+= i.count;
          }
        }
        power+=p;
      });
      
      storege.push({
        el: el,
        power: power
      });
    })
    
    let highestNum = Math.max(...storege.map(o => o.power));
    let reduced = highestNum / storege.length;
    reduced = highestNum - reduced;
    
    let results = storege.filter(r => {
      return r.power >= reduced;
    });
    
    if(results.length === 0){
      $(".recommended_words").html('<p class="ampty_text">Nothing to show yet...</p>');
    }else{
      $('.recommended_words').html("");
      results.forEach(el => {
        $('.recommended_words').append(`<div class="wordle_word">${el.el}</div>`);
      });
    }
    
    let highestChar = Math.max(...commons.map(o => o.count));
    let reducedChar = highestChar / commons.length;

    let reducedRommons = commons.filter(c => {
      return c.count >= reducedChar;
    });

    if(results.length === 0){
      $(".common_letters").html('<p class="ampty_text">Nothing to show yet...</p>');
    }else{
      $('.common_letters').html("");
      reducedRommons.forEach(el => {
        $('.common_letters').append(`<div class="char_prev">${el.ch.toUpperCase()} <span>(${el.count})<span></span></span></div>`);
      });
    }
  }
  
  function setEmptyWarning(){
    let empty = true;
    $('.search_bar').each(function(){
      if($(this).val() !== ""){
        empty = false;
      }
    });

    $(".empty_notice").html("");
    if(empty){
      $(".empty_notice").html(`<p class="ampty_text"><strong>NOTICE: </strong> Type any letter that you have already guessed in the boxes to see some result.</p>`);
    }
  }
  
  //   Mnage data
  let dataLength = 50;
  function dataManage(){
    let output = getCorrectLetterFilter(dataSource);
    output = getMisplacedLetterFilter(output);
    output = getIncorrect(output);
    dataLength = output.length;

    let empty = true;
    $('.search_bar').each(function(){
      if($(this).val() !== ""){
        empty = false;
      }
    });
    
    if(empty){
      output = [];
    }
    
    let limit = $("#potential_answer_limiter").attr('data-len');
    
    $("#lengthView").text('('+output.length+')');
    if(output.length === 0){
      $(".potential_answers").html('<p class="ampty_text">Nothing to show yet...</p>');
    }else{
      $('.potential_answers').html("");
      $('.potential_answers').append(output.map((el, ind) => { if(ind <= limit) return `<div class="wordle_word">${el}</div>`}));
    }

    if(output.length > 50){
      $("#potential_answer_limiter").show();
    }else{
      $("#potential_answer_limiter").hide();
    }
    
    commonRecommended(output);
    setEmptyWarning();
  }
  dataManage();
  
  $(document).on("click", "#potential_answer_limiter", function(){
    if(parseInt($(this).attr('data-len')) == 50){
      $(this).attr('data-len', dataLength);
    }else{
      $(this).attr('data-len', 50);
    }
    dataManage();
  });
  
  //   Input action
  $('.wordle_filter_bar.correct').find('.search_bar').each(function(){
    $(this).on("input", function(){
      dataManage();
    });
  });
  
  $('.wordle_filter_bar.misplaced').find('.search_bar').each(function(){
    $(this).on("input", function(){
      dataManage();
    });
  });
  
  $('.wordle_filter_bar.incorrect').find('.search_bar').on("input", function(){
      dataManage();
  });
  
});