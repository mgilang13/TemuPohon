package com.example.mgilang13.temupohon;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.view.animation.AlphaAnimation;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class Pesan extends AppCompatActivity {

    EditText txtNamaPengunjung, txtEmailPengunjung, txtIsiPesan;
    Button btnSend;
    RequestQueue rq;

    String insertURL = "http://temupohon.com/android/insertPesan.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pesan);

        txtNamaPengunjung = (EditText) findViewById(R.id.txtNamaPengunjung);
        txtEmailPengunjung = (EditText) findViewById(R.id.txtEmailPengunjung);
        txtIsiPesan = (EditText) findViewById(R.id.txtIsiPesan);

        final String email = txtEmailPengunjung.getText().toString();


        btnSend = (Button) findViewById(R.id.btnPesan);

        rq = Volley.newRequestQueue(getApplicationContext());
        final AlphaAnimation buttonBack = new AlphaAnimation(1F, 0.8F);
        Button btnBack = (Button) findViewById(R.id.btnBack);
        btnBack.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                v.startAnimation(buttonBack);
                startActivity(new Intent(Pesan.this, MainActivity.class));
                Pesan.super.finish();
            }
        });

        final AlphaAnimation btnSendMessage = new AlphaAnimation(1f, 0.8f);
        btnSend.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (!validateEmail(txtEmailPengunjung.getText().toString()))
                {
                    txtEmailPengunjung.setError("Invalid email!");
                    txtEmailPengunjung.requestFocus();
                }
                else
                {
                    Toast.makeText(getApplicationContext(),"valid email address",Toast.LENGTH_SHORT).show();
                    v.startAnimation(btnSendMessage);
                    StringRequest request = new StringRequest(Request.Method.POST, insertURL, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String s) {

                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError volleyError) {

                        }
                    }) {
                        @Override
                        protected Map<String, String> getParams() throws AuthFailureError {
                            Map<String, String> parameters = new HashMap<String, String>();
                            parameters.put("nama", txtNamaPengunjung.getText().toString());
                            parameters.put("email", txtEmailPengunjung.getText().toString());
                            parameters.put("isi_pesan", txtIsiPesan.getText().toString());

                            return parameters;
                        }
                    };
                    rq.add(request);

                    Context context = getApplicationContext();
                    CharSequence text = "Pesan berhasil terkirim";
                    int duration = Toast.LENGTH_LONG;

                    Toast toast = Toast.makeText(context, text, duration);
                    toast.show();
                    startActivity(new Intent(Pesan.this, Pesan.class));

//                    Toast.makeText(getApplicationContext(),"Invalid email address", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    private boolean validateEmail(String email) {
        String emailPattern = "^(([\\w-]+\\.)+[\\w-]+|([a-zA-Z]{1}|[\\w-]{2,}))@"
                + "((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
                + "[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\."
                + "([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
                + "[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|"
                + "([a-zA-Z]+[\\w-]+\\.)+[a-zA-Z]{2,4})$";
        Pattern pattern = Pattern.compile(emailPattern);
        Matcher matcher = pattern.matcher(email);

        return matcher.matches();
    }
}
