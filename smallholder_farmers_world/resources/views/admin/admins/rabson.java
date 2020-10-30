*************************************************************************************

import javax.swing.JOptionPane;

public abstract class Question {

  

  static int nQuestions = 0;

  static int nCorrect = 0;

  String question;

  String correctAnswer;

  

  abstract String ask();

  

  void check() {

     nQuestions += 1;

     while (true) {

        String answer = (ask());

        answer = answer.toUpperCase();

        if (answer.contentEquals(correctAnswer)) {

           JOptionPane.showMessageDialog(null, "Correct");

           nCorrect += 1;

           return;

        }

        if (answer.equals("A") || answer.equals("B") || answer.equals("C") || answer.equals("D")

              || answer.equals("E")) {

           JOptionPane.showMessageDialog(null, "Incorrect. Try Again.");

           return;

        } else {

           JOptionPane.showMessageDialog(null, "Invalid answer. Please enter A,B,C,D,E");

        }

     }

  }

  

  static void showResults() {

     JOptionPane.showMessageDialog(null, nCorrect + " correct out of " + nQuestions + " questions ");

  }

}

*************************************************************************************

MultipleChoiceQuestion.java

*************************************************************************************

import javax.swing.JOptionPane;

public class MultipleChoiceQuestion extends Question{

  MultipleChoiceQuestion(String query, String a, String b, String c, String d, String e, String answer) {

     question = query + "\n";

     question += "A. " + a + "\n";

     question += "B. " + b + "\n";

     question += "C. " + c + "\n";

     question += "D. " + d + "\n";

     question += "E. " + e + "\n";

     correctAnswer = answer.toUpperCase();

  }

  String ask() {

     return JOptionPane.showInputDialog(question);

  }

}

*************************************************************************************

TrueFalseQuestion.java

*************************************************************************************

import javax.swing.JOptionPane;

public class TrueFalseQuestion extends Question{

  

  public TrueFalseQuestion(String question,String answer) {

     this.question="TRUE or FALSE: "+question;

     this.correctAnswer=answer;

     

        

  }

  @Override

  String ask() {

     String output="";

     nQuestions += 1;

     boolean flag = true;

     while (flag) {

        String answer = JOptionPane.showInputDialog(question);

        answer=answer.toUpperCase();

        if(answer.equals("T") || answer.equals("TRUE") || answer.equals("Y") || answer.equals("YES")) {

           answer="TRUE";

        }

        else if(answer.equals("F") || answer.equals("FALSE") || answer.equals("N") || answer.equals("NO")) {

           answer="FALSE";

        }

        if (answer.equals(correctAnswer)) {

           nCorrect += 1;

           flag=false;

           output= "Correct";

        }

        else if (answer.equals("TRUE") || answer.equals("FALSE")) {

           flag=false;

           output= "Incorrect. Try Again.";

        } else {

           flag = true;

           JOptionPane.showMessageDialog(null,"Invalid answer. Please enter TRUE or FALSE");

        }

     }

     return output;

  }

}

*************************************************************************************

Quiz.java

*************************************************************************************

import javax.swing.JOptionPane;

public class Quiz {

  static int nQuestions = 0;

  static int nCorrect = 0;

  public static void main(String[] args) {

     Question question = new MultipleChoiceQuestion("What is a quiz?",

           "a test of knowledge, especially a brief informal test given to students", "42", "a duck",

           "to get to the other side", "To be or not to be, that is the question.", "a");

     question.check();

     question = new MultipleChoiceQuestion("How much is a PS4 controller cost new?", "$10", "$20", "$30", "$40",

           "$60", "e");

     question.check();

     question = new MultipleChoiceQuestion("how many earth years does it take pluto to go around the sun?", "50 yrs",

           "124 yrs", "165 yrs", "248 yrs", "40000 years", "d");

     question.check();

     question = new MultipleChoiceQuestion("comic book time: who is the fastest man alive?", "Barry Allen",

           "Wally West", "Batman", "Usain Bolt", "ME", "a");

     question.check();

     question = new MultipleChoiceQuestion("what is 10*10?", "10", "1000", "100", "1", "IDK", "c");

     question.check();

     Question.showResults();

     

     Question question1 = new TrueFalseQuestion("The capital of England is Manchester?", "FALSE");

     JOptionPane.showMessageDialog(null,question1.ask());

     

     question1 = new TrueFalseQuestion("Half of 40 is 20?", "TRUE");

     JOptionPane.showMessageDialog(null,question1.ask());

     

     question1 = new TrueFalseQuestion("A triangle has four sides?", "FALSE");

     JOptionPane.showMessageDialog(null,question1.ask());

     

     question1 = new TrueFalseQuestion("Your liver pumps blood around your body?", "FALSE");

     JOptionPane.showMessageDialog(null,question1.ask());

     

     question1 = new TrueFalseQuestion("The biggest country in the world is Russia?", "TRUE");

        JOptionPane.showMessageDialog(null,question1.ask());

        

     Question.showResults();

  }

}