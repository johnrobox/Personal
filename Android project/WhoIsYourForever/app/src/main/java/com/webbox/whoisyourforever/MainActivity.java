package com.webbox.whoisyourforever;

import android.app.AlertDialog;
import android.content.ComponentName;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.content.IntentCompat;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.index_main);

        Button startButton = (Button) findViewById(R.id.startButton);
        startButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent gotoStart = new Intent(MainActivity.this, PickGender.class);
                 startActivity(gotoStart);
                //Intent gotoStart = new Intent(MainActivity.this, ChoosePage.class);
               // startActivity(gotoStart);
            }
        });

        Button exitButton = (Button) findViewById(R.id.exitButton);
        exitButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AlertDialog.Builder alert = new AlertDialog.Builder(MainActivity.this);
                alert.setTitle("Do you want to Exit?");
                // alert.setMessage("Message");

                alert.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int whichButton) {
                        Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                        ComponentName cn = intent.getComponent();
                        Intent mainIntent = IntentCompat.makeRestartActivityTask(cn);
                        mainIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK);
                        mainIntent.addFlags(Intent.FLAG_ACTIVITY_NO_HISTORY);
                        mainIntent.putExtra("close", true);
                        startActivity(mainIntent);
                        finish();
                    }

                });

                alert.setNegativeButton("Cancel",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int whichButton) {
                            }
                        });

                alert.show();
            }
        });

        if( getIntent().getBooleanExtra("close", false)){
            finish();
        }

    }

//    protected void showInputDialog() {
//
//
//        // get prompts.xml view
//        LayoutInflater layoutInflater = LayoutInflater.from(MainActivity.this);
//        View promptView = layoutInflater.inflate(R.layout.input_dialog, null);
//        AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(MainActivity.this);
//        alertDialogBuilder.setView(promptView);
//
//        final EditText editText = (EditText) promptView.findViewById(R.id.editText);
//
//
//        final RadioGroup radioSexGroup = (RadioGroup) findViewById(R.id.radioSex);
//
//
//        // find the radiobutton by returned id
//
//
//
//
//        // setup a dialog window
//        alertDialogBuilder.setCancelable(false)
//                .setPositiveButton("OK", new DialogInterface.OnClickListener() {
//                    public void onClick(DialogInterface dialog, int id) {
//
//                        int selectedId = radioSexGroup.getCheckedRadioButtonId();
//                        RadioButton radioSexButton = (RadioButton) findViewById(selectedId);
//                        String names = "";
//                        names = radioSexButton.getText().toString();
//                        // get selected radio button from radioGroup
////
// //                       int selectedId = radioSexGroup.getCheckedRadioButtonId();
////
////                        // find the radiobutton by returned id
////                        RadioButton radioSexButton = (RadioButton) findViewById(selectedId);
////                        String names = "";
////                        names = radioSexButton.getText().toString();
//                        Intent bringData = new Intent(MainActivity.this, Testing.class);
//                        bringData.putExtra("pick", names);
//                        startActivity(bringData);
//                    }
//                })
//                .setNegativeButton("Cancel",
//                        new DialogInterface.OnClickListener() {
//                            public void onClick(DialogInterface dialog, int id) {
//                                dialog.cancel();
//                            }
//                        });
//
//        // create an alert dialog
//        AlertDialog alert = alertDialogBuilder.create();
//        alert.show();
//    }
}
