package com.webbox.simplemath;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

/**
 * Created by su004 on 1/12/2016.
 */
public class QuestionTwoSuccess extends AppCompatActivity{

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.question_success);

        final TextView questionSuccess = (TextView) findViewById(R.id.questionSuccess);
        questionSuccess.setText("Congratulations ! You've got the correct answer.");

        TextView recup = (TextView) findViewById(R.id.recup);
        recup.setText("34 - 7 = 27");

        Button nextQuestion = (Button) findViewById(R.id.nextQuestion);
        nextQuestion.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(QuestionTwoSuccess.this, QuestionThree.class);
                startActivity(i);
            }
        });

    }
}
