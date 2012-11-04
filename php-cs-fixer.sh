#!/bin/sh

# http://cs.sensiolabs.org/

php php-cs-fixer fix ./ --fixers=linefeed,trailing_spaces,unused_use,php_closing_tag,short_tag,return,visibility,phpdoc_params,eof_ending,extra_empty_lines,include,PSR0,controls_spaces,elseif
