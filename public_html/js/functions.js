var Functions = {
    /*
     * Склонение числительных
     */
    pluralWord : function(number, words) {
        words = words || ['день', 'дня', 'дней'];
        cases = [2, 0, 1, 1, 1, 2];  
        return words[(number % 100 > 4 && number % 100 < 20)? 2 : cases[(number % 10 < 5)?number % 10 : 5]];  
    }
};
