<?php
/**
 * Zend Coding Standard.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   CVS: $Id: ZendCodingStandard.php,v 1.1 2007/08/09 04:51:52 squiz Exp $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

if (class_exists('PHP_CodeSniffer_Standards_CodingStandard', true) === false) {
    throw new PHP_CodeSniffer_Exception('Class PHP_CodeSniffer_Standards_CodingStandard not found');
}

/**
 * Zend Coding Standard.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: 1.1.0
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class PHP_CodeSniffer_Standards_Sxs_SxsCodingStandard extends PHP_CodeSniffer_Standards_CodingStandard
{


    /**
     * Return a list of external sniffs to include with this standard.
     *
     * The Zend standard uses some PEAR sniffs.
     *
     * @return array
     */
    public function getIncludedSniffs()
    {
        return array(
            ///////////////////////
            // Standard: Generic //
            ///////////////////////
            
            /* Classes: */
            /**
             * Reports errors if the same class or interface name is used in multiple files.
             */
            'Generic/Sniffs/Classes/DuplicateClassNameSniff.php',

            /* CodeAnalysis: */
            /**
             * This sniff class detected empty statement.
             *
             * This sniff implements the common algorithm for empty statement body detection.
             * A body is considered as empty if it is completely empty or it only contains
             * whitespace characters and|or comments.
             *
             * <code>
             * stmt {
             *   // foo
             * }
             * 
             * stmt (conditions) {
             *   // foo
             * }
             * </code>
             *
             * Statements covered by this sniff are <b>catch</b>, <b>do</b>, <b>else</b>,
             * <b>elsif</b>, <b>for</b>, <b>foreach<b>, <b>if</b>, <b>switch</b>, <b>try</b>
             * and <b>while</b>.
             */
            'Generic/Sniffs/CodeAnalysis/EmptyStatementSniff.php',
            /**
             * Detects for-loops that can be simplified to a while-loop.
             *
             * This rule is based on the PMD rule catalog. Detects for-loops that can be
             * simplified as a while-loop.
             *
             * <code>
             * class Foo {
             *     public function bar($x) {
             *         for (;true;) true; // No Init or Update part, may as well be: while (true)
             *     }
             * }
             * </code>
             */
            'Generic/Sniffs/CodeAnalysis/ForLoopShouldBeWhileLoopSniff.php',
            /**
             * Detects for-loops that use a function call in the test expression.
             *
             * This rule is based on the PMD rule catalog. Detects for-loops that use a
             * function call in the test expression.
             *
             * <code>
             * class Foo {
             *     public function bar($x) {
             *         $a = array(1, 2, 3, 4);
             *
             *         for ($i = 0; $i < count($a); $i++) {
             *              $a[$i] *= $i;
             *         }
             *     }
             * }
             * </code>
             */
            'Generic/Sniffs/CodeAnalysis/ForLoopWithTestFunctionCallSniff.php',
            /**
             * Detects incrementer jumbling in for loops.
             *
             * This rule is based on the PMD rule catalog. The jumbling incrementer sniff
             * detects the usage of one and the same incrementer into an outer and an inner
             * loop. Even it is intended this is confusing code.
             *
             * <code>
             * class Foo {
             *     public function bar($x)  {
             *         for ($i = 0; $i < 10; $i++)  {
             *             for ($k = 0; $k < 20; $i++) {
             *                 echo 'Hello';
             *             }
             *         }
             *     }
             * }
             * </code>
             */
            'Generic/Sniffs/CodeAnalysis/JumbledIncrementerSniff.php',
            /**
             * Detects unconditional if- and elseif-statements.
             *
             * This rule is based on the PMD rule catalog. The Unconditional If Statment
             * sniff detects statement conditions that are only set to one of the constant
             * values <b>true</b> or <b>false</b>
             *
             * <code>
             * class Foo {
             *     public function close() {
             *         if (true) {
             *             // ...
             *         }
             *     }
             * }
             * </code>
             */
            'Generic/Sniffs/CodeAnalysis/UnconditionalIfStatementSniff.php',
            /**
             * Detects unnecessary final modifiers inside of final classes.
             *
             * This rule is based on the PMD rule catalog. The Unnecessary Final Modifier
             * sniff detects the use of the final modifier inside of a final class which
             * is unnecessary.
             *
             * <code>
             * final class Foo {
             *     public final function bar() {
             *     }
             * }
             * </code>
             */
            'Generic/Sniffs/CodeAnalysis/UnnecessaryFinalModifierSniff.php',
            /**
             * Checks the for unused function parameters.
             *
             * This sniff checks that all function parameters are used in the function body.
             * One exception is made for empty function bodies or function bodies that only
             * contain comments. This could be usefull for the classes that implement an
             * interface that defines multiple methods but the implementation only needs some
             * of them.
             */
            'Generic/Sniffs/CodeAnalysis/UnusedFunctionParameterSniff.php',
            /**
             * Detects unnecessary overriden methods that simply call their parent.
             *
             * This rule is based on the PMD rule catalog. The Useless Overriding Method
             * sniff detects the use of methods that only call their parent classes's method
             * with the same name and arguments. These methods are not required.
             *
             * <code>
             * class FooBar {
             *   public function __construct($a, $b) {
             *     parent::__construct($a, $b);
             *   }
             * }
             * </code>
             */
            'Generic/Sniffs/CodeAnalysis/UselessOverridingMethodSniff.php',

            /* ControlStructures: */
            /**
             *  Verifies that inline control statements are not present.
             */
            'Generic/Sniffs/ControlStructures/InlineControlStructureSniff.php',

            /* Files: */
            /**
             * Checks that end of line characters are correct.
             */
            'Generic/Sniffs/Files/LineEndingsSniff.php',

            /* Formatting: */
            /*
             * Ensures each statement is on a line by itself.
             */
            'Generic/Sniffs/Formatting/DisallowMultipleStatementsSniff.php',
            /**
             * Checks alignment of assignments. If there are multiple adjacent assignments,
             * it will check that the equals signs of each assignment are aligned. It will
             * display a warning to advise that the signs should be aligned.
             */
//            'Generic/Sniffs/Formatting/MultipleStatementAlignmentSniff.php',
            /*
             * Ensures there is a single space after cast tokens.
             */
            'Generic/Sniffs/Formatting/SpaceAfterCastSniff.php',

            /* Functions */
            /**
             * Checks that the opening brace of a function is on the same line
             * as the function declaration.
             */
            'Generic/Sniffs/Functions/OpeningFunctionBraceKernighanRitchieSniff.php',
            /**
             * Ensures that variables are not passed by reference when calling a function.
             */
            'Generic/Sniffs/Functions/CallTimePassByReferenceSniff.php',

            /* Metrics */
            /*
             * Checks the cyclomatic complexity (McCabe) for functions.
             *
             * The cyclomatic complexity (also called McCabe code metrics)
             * indicates the complexity within a function by counting
             * the different paths the function includes.
             */
            'Generic/Sniffs/Metrics/CyclomaticComplexitySniff.php',
            /*
             * Checks the nesting level for methods.
             */
            'Generic/Sniffs/Metrics/NestingLevelSniff.php',

            /* Naming convention */
            /*
             * Favor PHP 5 constructor syntax, which uses "function __construct()".
             * Avoid PHP 4 constructor syntax, which uses "function ClassName()".
             */
            'Generic/Sniffs/NamingConventions/ConstructorNameSniff.php',
            /*
             * Ensures that constant names are all uppercase.
             */
            'Generic/Sniffs/NamingConventions/UpperCaseConstantNameSniff.php',

            /* PHP */
            /*
             * Makes sure that shorthand PHP open tags are not used.
             */
            'Generic/Sniffs/PHP/DisallowShortOpenTagSniff.php',
            /*
             * Discourages the use of alias functions that are kept in PHP for compatibility
             * with older versions. Can be used to forbid the use of any function.
             *
             * 'sizeof' => 'count',
             * 'delete' => 'unset',
             */
            'Generic/Sniffs/PHP/ForbiddenFunctionsSniff.php',
            /*
             * Checks that all uses of true, false and null are lowerrcase.
             */
            'Generic/Sniffs/PHP/LowerCaseConstantSniff.php',

            /* Strings */
            /*
             * Checks that two strings are not concatenated together; suggests
             * using one string instead.
             */
            'Generic/Sniffs/Strings/UnnecessaryStringConcatSniff.php',

            /* WhiteSpace */
            'Generic/Sniffs/WhiteSpace/DisallowTabIndentSniff.php',
            /*
             * Checks that control structures are structured correctly, and their content
             * is indented correctly. This sniff will throw errors if tabs are used
             * for indentation rather than spaces.
             */
            'Generic/Sniffs/WhiteSpace/ScopeIndentSniff.php',

             ///////////////////
             // Standard: Sxs //
             ///////////////////
             /* Files */
             'Sxs/Sniffs/Files/LineLengthSniff.php',
             /* Classes */
             'Sxs/Sniffs/Classes/ClassDeclarationSniff.php',
            /* NamingConventions */
             'Sxs/Sniffs/NamingConventions/ValidFunctionNameSniff.php',
             'Sxs/Sniffs/NamingConventions/ValidVariableNameSniff.php',

              ///////////////////////
              // Standard: PEAR //
              ///////////////////////
              /* Commenting: */
              'Sxs/Sniffs/Commenting/FileCommentSniff.php',
              'Sxs/Sniffs/Commenting/ClassCommentSniff.php',
              'PEAR/Sniffs/Commenting/FunctionCommentSniff.php',
              'PEAR/Sniffs/Commenting/InlineCommentSniff.php',
//            'PEAR/Sniffs/ControlStructures/ControlSignatureSniff.php',
//            'PEAR/Sniffs/Functions/FunctionCallArgumentSpacingSniff.php',
//            'PEAR/Sniffs/Functions/FunctionCallSignatureSniff.php',
//            'PEAR/Sniffs/Functions/ValidDefaultValueSniff.php',
//            'PEAR/Sniffs/WhiteSpace/ScopeClosingBraceSniff.php',

               ///////////////////////
               // Standard: Squiz //
               ///////////////////////
               /*
                * Tests for functions outside of classes.
                */
                'Squiz/Sniffs/Functions/GlobalFunctionSniff.php',
                'Squiz/Sniffs/Commenting/EmptyCatchCommentSniff.php',
                'Zend/Sniffs/Files/ClosingTagSniff.php'
        );
    }//end getIncludedSniffs()
}//end class