package com.webbox.whoisyourforever;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;

import org.w3c.dom.Text;

/**
 * Created by su004 on 1/15/2016.
 */
public class Testing extends AppCompatActivity {

    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.testing);

        Intent getValues = getIntent();
        String pick = getValues.getStringExtra("pick");
        TextView textView = (TextView) findViewById(R.id.textView);
               textView.setText(pick);


//        Button button = (Button) findViewById(R.id.button);
//
//        button.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View v) {
//
//                RadioGroup radioSexGroup = (RadioGroup) findViewById(R.id.radioSex);
//
//                // get selected radio button from radioGroup
//                int selectedId = radioSexGroup.getCheckedRadioButtonId();
//
//                // find the radiobutton by returned id
//                RadioButton radioSexButton = (RadioButton) findViewById(selectedId);
//                String myRadio = "";
//                myRadio = radioSexButton.getText().toString();
//
//                TextView textView = (TextView) findViewById(R.id.textView);
//                textView.setText(myRadio);
//            }
//        });

    }
}
