package com.webbox.simplemath;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

/**
 * Created by su004 on 1/12/2016.
 */
public class QuestionTwo extends AppCompatActivity {

    protected void onCreate(Bundle savedInstanceState){

        super.onCreate(savedInstanceState);
        setContentView(R.layout.question_one_main);

        TextView questionOne = (TextView) findViewById(R.id.questionOne);
        questionOne.setText(" 34 - 7 = ?");

        Button submitQuestionOne = (Button) findViewById(R.id.submitQuestionOne);
        submitQuestionOne.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                EditText answerOne = (EditText) findViewById(R.id.questionOneAnswer);
                String toString = answerOne.getText().toString();
                TextView displayFeedbackError = (TextView) findViewById(R.id.displayFeedbackError);
                if (toString.matches("")) {
                    displayFeedbackError.setText("You should type your answer before you submit.");
                } else if (Integer.parseInt(toString) == 27) {
                    Intent i = new Intent(QuestionTwo.this, QuestionTwoSuccess.class);
                    startActivity(i);
                } else {
                    displayFeedbackError.setText("Your answer is wrong.");
                }
            }
        });
    }
}
