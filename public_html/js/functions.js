var Functions = {
    /*
     * Склонение числительных
     */
    pluralWord : function(number, words) {
        words = words || ['день', 'дня', 'дней'];
        cases = [2, 0, 1, 1, 1, 2];  
        return words[(number % 100 > 4 && number % 100 < 20)? 2 : cases[(number % 10 < 5)?number % 10 : 5]];  
    },
    
    /* Функция isValidEmail принимает один или 2 аргумента:
     * email - электронный адрес для проверки;
     * strict - необязательный логический параметр (true/false), который 
     * определяет строгую проверку при которой пробелы до и после адреса 
     * считаются ошибкой
     *
     * В качестве результата функция возвращает либо true, либо false
     */
    isValidEmail : function(email, strict)
    {
        if ( !strict ) email = email.replace(/^\s+|\s+$/g, '');
        return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
    },
    
    goToTop : function() {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
    }
};
